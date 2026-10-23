# 若萱云盘 · Vue3 前端

给已运行的 ModStart（PHP7）网盘后端配的独立 Vue3 前端，用于课程实训演示。

- **线上地址：** <http://pan.7107.com.cn/app/>
- **测试账号：** `demo` / `123456`
- **源码目录：** `/opt/pan-vue`
- **构建产物：** `/var/www/pan-vue`（nginx `location ^~ /app/` → alias，`try_files` 回退 `/app/index.html`）
- **后端：** Docker 容器 `pan-web`（PHP7 + ModStart，`127.0.0.1:8088`）+ `pan-db`（MySQL 5.6）。本前端 **只调用 `/api`，未改动任何后端代码与 nginx 配置**。

---

## 技术栈

| 能力 | 选型 | 说明 |
| --- | --- | --- |
| 框架 | Vue 3（`<script setup>`） | 组合式 API，全部页面与组件均使用 |
| 构建 | Vite 5 | `base: '/app/'`，`@` → `src`，vendor 手动分包（vue / element / echarts） |
| 路由 | Vue Router 4 | `createWebHistory('/app/')`，懒加载 + 全局前置守卫 |
| 状态 | Pinia | `stores/auth.js`（登录态）、`stores/file.js`（当前目录 / 列表 / 配额） |
| UI | Element Plus | 表格、弹窗、分页、消息、图标；主题变量微调（主色 `#3550a3`） |
| 图表 | ECharts 5 | 用量环形图 + 文件类型分布横向柱图 |
| 请求 | axios | 统一封装 `api/request.js`：`baseURL=/api`、`withCredentials`、拦截器统一解包与报错 |

---

## 目录结构

```
/opt/pan-vue
├── index.html
├── vite.config.js            # base /app/、proxy 127.0.0.1:8088、手动分包
├── package.json
├── screenshots/              # 11 张界面截图（见文末）
├── SPEC.md                   # 甲方给的开发规格（原始需求）
└── src
    ├── main.js               # createApp + Pinia + Router + Element Plus(zh-cn)
    ├── App.vue
    ├── api
    │   ├── request.js        # axios 实例 / 拦截器 / 未登录跳转 / 全局 ElMessage
    │   ├── auth.js           # 登录、退出、验证码、修改密码
    │   ├── disk.js           # 目录列表、增删改移动、上传两段式、下载、预览、分享
    │   ├── share.js          # 分享列表 / 取消分享
    │   └── recycle.js        # 回收站列表 / 还原 / 彻底删除
    ├── stores
    │   ├── auth.js           # 登录态（localStorage 记忆用户名）
    │   └── file.js           # 目录栈、folders/files 拆分、面包屑、配额
    ├── router/index.js       # 路由表 + 登录守卫 + 标题
    ├── components
    │   ├── Layout.vue        # 侧栏 + 顶栏 + 用户下拉 + 移动端抽屉
    │   ├── Breadcrumb.vue    # 面包屑（基于后端 dirs 祖先链）
    │   ├── FileTable.vue     # 文件表格（多选 / 双击进入 / 行内操作）
    │   ├── UploadDialog.vue  # 拖拽多选上传 + 进度 + 秒传 + 同名自动重命名
    │   ├── MoveDialog.vue    # 移动到…（目录树选择）
    │   └── ShareDialog.vue   # 创建分享（有效期、提取码、复制链接）
    ├── views
    │   ├── Login.vue         # 登录页（渐变背景 + 卡片）
    │   ├── Files.vue         # 文件管理主页面
    │   ├── Shares.vue        # 我的分享
    │   ├── Recycle.vue       # 回收站
    │   ├── Dashboard.vue     # 用量中心（ECharts）
    │   ├── Profile.vue       # 个人中心 + 修改密码
    │   └── NotFound.vue      # 404
    ├── utils
    │   ├── format.js         # 字节/时间格式化、类型名、文件图标
    │   └── uploader.js       # 内容 MD5 + 1MB 分片上传协议实现
    └── styles/index.scss     # 设计变量、卡片、按钮、响应式
```

---

## 启动与部署

```bash
# 依赖（npm 源已切 npmmirror）
cd /opt/pan-vue
npm install

# 本地开发：http://127.0.0.1:5199/app/ ，/api 代理到 127.0.0.1:8088
npm run dev            # 端口在 vite.config.js 里写死 5199，strictPort

# 生产构建 + 部署
npm run build                        # 产物 dist/（index.html + assets/）
rsync -a --delete dist/ /var/www/pan-vue/
```

> `base` 必须是 `/app/`，否则 JS/CSS 会 404；`/app/` 目录下的旧占位 `index.html` 已被构建产物覆盖。

---

## 接口清单（**以 curl 实测为准**，与 SPEC 的差异已标注）

统一响应 `{code, msg, data}`，`code=0` 成功；`code=1001` 表示未登录（带 `redirect`），前端拦截器会跳回登录页。所有接口都用 Cookie Session 鉴权，前端 `withCredentials: true` + 同源 `/api`。

### 认证

| 接口 | 入参（form） | 实测返回 |
| --- | --- | --- |
| `POST /api/login` | `username`, `password` | `{"code":0,"msg":"ok"}`（**不含任何用户信息**） |
| `GET /api/logout` | — | `{"code":0}` |
| `GET /api/login_captcha` | — | `data.image = "data:image/png;base64,..."`（当前登录未开启验证码） |
| `POST /api/member_profile/password` | `passwordOld`, `passwordNew`, `passwordRepeat` | 成功 `code 0`；旧密码错 → `{"code":-1,"msg":"旧密码不正确"}` |

### 网盘

| 接口 | 入参（form） | 实测返回 |
| --- | --- | --- |
| `GET /api/pan/disk_info` | — | `data:{panSizeLimit: 1073741824, panSizeUsed: 90}` |
| `GET /api/pan/disk_file/list` | `dirFileId`, `page`, `pageSize` | `data:{total, records[], dirs[], hasMore}` |
| `POST /api/pan/disk_file/create_dir` | `dirFileId`, `fileName` | `data:{dirFileId: 518}` |
| `POST /api/pan/disk_file/rename` | `fileId`, `fileName`（**不含扩展名**） | `data:{fileName:"renamed2.txt"}` |
| `POST /api/pan/disk_file/delete` | `fileIds="1,2"` | `code 0`（进回收站） |
| `POST /api/pan/disk_file/move` | `fileIds="1,2"`, `toDirFileId` | `code 0` |
| `POST /api/pan/disk_file/share` | `fileIds="1"`, `name`, `expireDay`, `type=1` | `data.share:{url, code, expireTime}` |
| `POST /api/pan/disk_file/preview` | `id` | `data:{file:{...}}` |
| `GET /api/pan/disk_file/download` | `fileIds="1"` | 文件流（`Content-Type` / `Content-Length` 正确），前端用 `window.open` 直下 |

### 分享 / 回收站

| 接口 | 入参（form） | 实测返回 |
| --- | --- | --- |
| `GET /api/pan/disk_share/list` | `page`, `pageSize` | `data:{total, records:[{id, name, code, url, expireTime, shareTime, status}]}` |
| `POST /api/pan/disk_share/delete` | `ids="1,2"` | `code 0` |
| `GET /api/pan/disk_recycle/list` | `page`, `pageSize` | `data:{total, records:[{id, deleteTime, ...}]}` |
| `POST /api/pan/disk_recycle/restore` | `ids="1,2"`（**回收站记录 id**） | `code 0` |
| `POST /api/pan/disk_recycle/delete` | `ids="1,2"` | `code 0`（彻底删除） |

### 与 SPEC 不一致的地方（实测后按后端实现，前端已适配）

1. **`list` 的 `records` 里同时包含文件夹和文件**（用 `isDir` 区分），`dirs` 不是子目录，而是**当前目录的祖先链（含当前目录）**。
   → 前端在 `stores/file.js` 里按 `isDir` 拆成 `folders` / `files`，并用 `dirs` 渲染面包屑（`[{id:0,name:'全部文件'}, ...dirs]`）。
2. **`rename` 的 `fileName` 必须是不含扩展名的基础名**：传 `renamed.txt` 会得到 `renamed.txt.txt`，传 `renamed2` 才会得到 `renamed2.txt`。
   → `Files.vue` 的重命名弹窗会先剥掉扩展名再提交，提交后按后端返回值刷新。
3. **后端不支持 `keywords` 搜索**（`DiskFileController` 里没有关键字条件）。`fileType`、`search[type]=dir` 可用。
   → 搜索改为“拉取当前目录全量分页后前端本地过滤”，只影响搜索，不影响分页浏览。
4. **回收站的 `restore` / `delete` 入参是回收站记录 `id`，不是 `fileIds`**（SPEC 写的是 `fileIds`）。传 `ids=509`（文件 id）会返回 HTML 错误页「回收站记录不存在」。
5. **`login` 不返回用户信息，也没有 user info 接口**（session 是 httpOnly cookie，JS 读不到）。
   → 登录成功后把用户名写入 `localStorage['pan:user']` 作为前端登录态依据；这是已知限制（换设备/清缓存需重登后再次写入）。

### 上传：两段式分片协议（`api/disk.js` + `utils/uploader.js`）

服务端 PHP 限制：`upload_max_filesize=2M`、`post_max_size=8M`、`memory_limit=128M`，因此**不能整文件直传**，前端固定 **1MB 分片**。

```
# 1) init（multipart/form-data）
action=init
name, type(mime), lastModifiedDate, size, chunks, dirFileId, hash
→ {code:0, data:{hash(服务端 token), chunkUploaded, path, fullPath}}
   命中已有内容时 → {code:0, data:{uploadedChunks:[1..n]}}  ← 秒传，文件已入库，无需再传

# 2) 分片（multipart，chunk 从 0 开始）
action=upload, 同一批字段 + chunk + file=<blob>
→ 未传完 {data:{chunks, chunk, finished:false}}
→ 最后一片 {data:{data:{path, filename, size}, fullPath}}
```

实测要点（踩过的坑，已写进代码注释）：

- **`hash` 必须是文件内容的 MD5**（用 `spark-md5` 分片计算）。`pan_file.hash` 有唯一索引，空 hash 或复用固定值会报 `MultiPartUpload combile file failed` / `Duplicate entry`。
- 服务端用 `md5(serialize(init 字段))` 作为上传 token，所以 **init 与分片请求的 `name/type/lastModifiedDate/size/chunks/dirFileId/hash` 必须完全一致**，否则 token 对不上。
- init 返回的 `data.hash` 是**服务端 token**，不是内容 MD5，别拿它当秒传依据；秒传看的是 `uploadedChunks` 是否非空。
- `pan_member_file` 有唯一索引 `(memberUserId, pid, fileName)`：**同目录重名（尤其同内容秒传）后端会直接 500 抛 QueryException**。前端在开始上传前先查当前目录已有文件名，**自动重命名为 `xxx (1).ext`** 再传，并在任务行里提示。
- 允许的后缀由后端 `DiskFileUtil::allExtensions()` 决定：`jpg,jpeg,png,gif,mp4,mkv,doc,docx,ppt,pptx,xls,xlsx,pdf,js,txt,json`。前端 `<el-upload accept>` 已同步该列表，选错后缀时后端返回 `{"code":-1,"msg":"文件后缀bin不允许"}` 并在任务行内展示。

---

## 功能清单

1. **登录页 `/login`**：渐变背景 + 卡片式表单，账号密码校验、6 位以上密码提示、错误用内联 `el-alert`（不重复弹全局消息）、记住上次用户名、URL `?redirect=` 回跳。
2. **文件管理 `/files`**：面包屑导航（支持点击任意层级）、文件夹/文件同表展示（图标、大小、类型标签、时间）、单击进入文件夹、双击行进入、新建文件夹、重命名、删除（确认框）、移动到（目录树）、下载、分享、多选批量删除/移动/分享、分页（总数/每页条数）、空状态引导。
3. **上传 `UploadDialog`**：拖拽或多选、任务队列、MD5 计算进度、分片上传进度条、秒传提示、同名自动重命名、单个失败不影响其他任务、上传完成自动刷新列表与配额。
4. **我的分享 `/shares`**：分享名称、提取码、状态（生效中 / 已过期 / 已取消）、创建时间、有效期、一键复制“链接 + 提取码”、取消分享、空状态。
5. **回收站 `/recycle`**：列表（名称、类型、删除时间）、单条/批量还原、单条/批量彻底删除（二次确认）、空状态。
6. **用量中心 `/dashboard`**：4 张统计卡片（文件数 / 文件夹数 / 已用 / 剩余）+ ECharts 环形用量图（中心显示百分比）+ 文件类型分布横向柱图（前端遍历目录聚合，因为后端没有全局统计接口），窗口 resize 自适应、组件卸载 dispose。
7. **个人中心 `/profile`**：账号卡片（首字母头像）、空间用量描述列表 + 进度条、修改密码表单（旧密码/新密码/确认，前端校验一致性，旧密码错误内联提示，改完自动退出重登）、退出登录。
8. **全局**：`Layout.vue` 深蓝渐变侧栏 + 顶栏（折叠按钮、页面标题、用户下拉）、路由守卫未登录跳登录并带 redirect、axios 拦截器统一 `code!==0` 报错、HTTP 5xx/超时/413 友好提示、404 页面、≤768px 侧栏变抽屉（无横向溢出）。

---

## 截图说明（`screenshots/`）

| 文件 | 内容 |
| --- | --- |
| `01-login.png` | 登录页（渐变背景 + 登录卡片） |
| `02-files.png` | 文件管理：侧栏、面包屑、文件表格、批量操作栏、分页 |
| `03-files-inside.png` | 进入「学习资料」后的目录内视图与面包屑层级 |
| `04-upload.png` | 上传弹窗：拖拽区 + 任务队列 + 进度条 |
| `05-share-dialog.png` | 创建分享成功后展示链接 / 提取码 / 有效期，可一键复制 |
| `06-shares.png` | 我的分享列表（生效状态、提取码、有效期、取消分享） |
| `07-recycle.png` | 回收站（还原 / 彻底删除，批量操作） |
| `08-dashboard.png` | 用量中心：统计卡片 + 环形用量图 + 文件类型分布图 |
| `09-profile.png` | 个人中心：账号信息、空间用量、修改密码、退出登录 |
| `10-mobile.png` | 移动端 390×844 视图（侧栏收起、表格自适应） |
| `11-mobile-drawer.png` | 移动端抽屉菜单展开 |

截图由 Playwright 直连线上地址 <http://pan.7107.com.cn/app/> 用 `demo` 账号真实操作后截取，控制台无报错。

---

## 验收记录（本机实跑输出）

```
$ curl -H "Host: pan.7107.com.cn" http://127.0.0.1/app/ -o /dev/null -w "%{http_code}"
200

$ grep -oE '/app/assets/[A-Za-z0-9_.-]+\.(js|css)' 抽出的资源逐个 curl
200  /app/assets/index-DYRFqINy.js
200  /app/assets/element-CFt-pWOO.js
200  /app/assets/vue-Ba_bSJaa.js
200  /app/assets/index-0BwZUQJO.css
（assets 目录共 24 个文件，深链 /app/files、/app/dashboard 均回退 200）

$ curl -c /tmp/vj -H "Host: pan.7107.com.cn" -X POST -d "username=demo&password=123456" \
       http://127.0.0.1/api/login
{"code":0,"msg":"ok"}

$ init → 分片 → 完成
{"code":0,"data":{"hash":"4fa2...","chunkUploaded":0,"path":"aaqj...txt"}}
{"code":0,"data":{"chunks":"3","chunk":"0","finished":false}}
{"code":0,"data":{"chunks":"3","chunk":"1","finished":false}}
{"code":0,"data":{"data":{"category":"disk","path":"2026/10/21/15191_tfjt_3449.txt","filename":"验收上传.txt","size":2971933},"fullPath":"/data/disk/2026/10/21/15191_tfjt_3449.txt"}}

$ 深链回退 /app/login /app/files /app/shares /app/recycle /app/dashboard /app/profile
全部 200
$ http://pan.7107.com.cn/app/  与  http://pan.7107.com.cn/api/pan/disk_info
全部 200
```

浏览器端（Playwright，线上地址）验证：登录 → 文件列表 → 新建文件夹 → 3.3MB 文件 4 分片上传成功 → 同内容再次上传走秒传并自动改名 → 创建分享 → 删除进回收站 → 还原 → 用量中心两个图表渲染 → 移动端抽屉展开；**控制台 0 报错**。

---

## 已知限制

1. 后端没有“当前用户信息”接口，刷新后靠 `localStorage` 里的用户名维持前端登录态；真正失效时由接口返回 `code:1001` 触发重新登录。
2. 后端不支持关键字搜索，搜索是前端在当前目录内本地过滤（不跨目录）。
3. 文件夹暂不支持创建分享（`openShare` 会提示），后端虽然能建，但分享落地页的文件夹行为未验证。
4. 大文件（>1GB）受账号配额 `panSizeLimit` 限制；单文件分片数较多时上传时间取决于网络。
5. 用量中心需要遍历目录聚合类型分布，目录极多时会多花几秒（当前演示数据无压力）。

---

## 📦 仓库结构（后端在 `backend/`）

| 目录 | 内容 | 说明 |
| --- | --- | --- |
| `src/` `index.html` `vite.config.js` | **前端**（Vue3 + Vite + Pinia + Element Plus） | 本次实训主要开发成果 |
| `backend/` | **后端**（ModStart / Laravel 5.5 + PHP 7.0 + MySQL 5.6） | 网盘系统后端，详见 `backend/BACKEND.md` |
| `database/` | 建表 SQL 与数据库设计 | 37 张表 |
| `docs/` | 接口与开发文档 | — |

> **后端说明**：后端基于 ModStart 二次开发，业务能力集中在 `module/Pan`（文件/目录、分片上传、回收站、配额、分享）。
> 前端为独立重写，仅通过 `/api` 通信，**未改动后端业务逻辑**。`backend/` 中已按 `.gitignore` 排除
> `vendor/`、`storage/`、`.env`、数据库导出与上传文件，不含任何密钥或用户数据。
