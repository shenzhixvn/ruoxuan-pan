# 网盘系统 Vue3 前端 —— 开发规格（2026-10-21）

## 背景
后端是已跑起来的 ModStart（Laravel5 + PHP7）网盘，Docker 容器 `pan-web` 监听 127.0.0.1:8088，
通过 nginx 域名 `pan.7107.com.cn` 对外。现在要给这套后端**配一个独立的 Vue3 前端**，
用于课程实训作业（评分表要求：Vue 框架、组件化、路由、Pinia、接口联调、异常处理、代码规范）。
PHP 后端**不要改**，只做前端。

## 目录与部署
- 源码目录：`/opt/pan-vue`
- 构建产物目录（nginx 已配好）：`/var/www/pan-vue`，访问路径 **http://pan.7107.com.cn/app/**
- Vite 必须设 `base: '/app/'`（否则静态资源 404）
- nginx 已配：`location ^~ /app/` → alias `/var/www/pan-vue/`，try_files 回退 `/app/index.html`；
  `location /` → proxy 8088（承载 `/api/*` 和原 PHP 页面）

## 技术栈（硬性要求，评分点）
- Vue 3（`<script setup>` 组合式 API）
- Vue Router 4（history 模式，base `/app/`）
- Pinia（至少 auth store + file store）
- Element Plus（UI 组件）
- axios（统一封装 request.js：baseURL `/api`、`withCredentials: true`、响应拦截统一处理 `code !== 0` 抛错 + ElMessage）
- ECharts（用量仪表盘饼图 + 文件类型分布）
- 组件化：至少拆出 `FileTable.vue`、`UploadDialog.vue`、`Breadcrumb.vue`、`Layout.vue`
- Vite 构建

## 后端 API 契约（全部同源 `/api`，cookie session 鉴权）

统一响应：`{ "code": 0, "msg": "ok", "data": {...} }`；`code != 0` 即业务错误，`msg` 是中文提示。
未登录返回 `code: 1001,msg:"请登录",redirect:"/login?..."` → 前端需跳回登录页。

### 认证
- `POST /api/login` 表单 `username`, `password` → `{code:0}`
  （当前 `loginCaptchaEnable` 关闭，无需验证码；仍建议保留验证码输入框的兼容分支）
- `GET /api/logout` → 退出
- `GET /api/login_captcha` → `{code:0,data:{image:"data:image/png;base64,..."}}`（备用）

### 网盘
- `GET /api/pan/disk_info` → `data:{panSizeLimit, panSizeUsed}`（字节）
- `GET /api/pan/disk_file/list?dirFileId=0&page=1&pageSize=20&keywords=`
  → `data:{total, records:[...], dirs:[...], hasMore}`
  记录字段：`id`(目录项 id)、`pid`、`fileId`、`fileName`、`ext`、`type`、`size`、`isDir`(bool)、`uploadTime`、`_sizeFormat`
  注意：`records` 里是文件，`dirs` 是子目录（字段结构相同，`isDir=true`）
- `POST /api/pan/disk_file/create_dir`  `dirFileId=0`, `fileName=名称`
- `POST /api/pan/disk_file/rename`  `fileId`, `fileName`
- `POST /api/pan/disk_file/delete`  `fileIds="1,2"`（逗号分隔）
- `POST /api/pan/disk_file/move`  `fileIds="1,2"`, `toDirFileId`
- `POST /api/pan/disk_file/share`  `fileIds="1"`, `name`, `expireDay`, `type=1`
- `POST /api/pan/disk_file/preview`  `id` → `data:{file:{...}}`
- `GET /api/pan/disk_file/download?fileIds=1`（返回文件流，前端用 `window.open` 或 `<a download>`）

### 上传（分段协议，务必按此实现）
第 1 步 init（`multipart/form-data`）：
```
POST /api/pan/disk_upload
action=init, name, type(mime), lastModifiedDate, size, chunks, dirFileId
→ data:{hash, chunkUploaded:0, ...}
```
第 2 步 逐块上传（每块可整文件一块，`chunks=1`）：
```
POST /api/pan/disk_upload
file=<blob>, action=upload, chunk=0, chunks=1, name, type, lastModifiedDate, size, dirFileId
→ 最后一块返回 data:{data:{path,filename,size}, fullPath}
```
大文件按 `chunks = ceil(size/chunkSize)`，`chunk` 从 0 递增；每块都用同一 token（session 内）。

### 分享 / 回收站
- `GET /api/pan/disk_share/list` → `data:{total, records:[{id,name,...}]}`
- `POST /api/pan/disk_share/delete` `ids="1"`（或 fileIds，按后端兼容处理）
- `GET /api/pan/disk_recycle/list` → `data:{total, records}`
- `POST /api/pan/disk_recycle/restore` `fileIds`
- `POST /api/pan/disk_recycle/delete` `fileIds`

**实现时先用 curl 实测每个接口的入参名和返回结构（不要猜），以实测为准；发现与本文不符，按实测改并记录到 README。**

## 页面与功能（7 个必须能演示的点）
1. **登录页** `/login`：账号密码、错误提示（做点视觉设计，不要裸表单）
2. **文件管理** `/files`（主页面）：面包屑目录导航、文件/文件夹表格、双击进入文件夹、
   新建文件夹、上传（含进度条与多选）、重命名、删除、移动、下载、分享
3. **我的分享** `/shares`：列表 + 取消分享
4. **回收站** `/recycle`：列表 + 还原 + 彻底删除
5. **用量中心** `/dashboard`：ECharts 存储用量环形图 + 文件类型分布柱状图 + 统计卡片（文件数/已用/剩余）
6. **个人中心** `/profile`：显示登录账号、修改密码入口（可调用 `POST /api/member_profile/password`）
7. **全局**：`Layout.vue` 侧边栏 + 顶栏（折叠、面包屑、用户下拉退出）；路由守卫未登录跳 `/login`；
   统一 loading 与错误提示、空状态、分页

## 细节要求
- 视觉：深蓝/靛青渐变侧栏 + 浅灰内容区，Element Plus 主题变量微调，卡片圆角 12px，悬浮阴影；
  移动端 ≤768px 侧栏折叠为抽屉
- 代码规范：目录 `src/{api,stores,router,views,components,utils,styles}`，组件 PascalCase，
  API 按模块拆文件（`api/auth.js`、`api/disk.js`、`api/share.js`）
- README.md 写：技术栈、目录结构、启动方式、接口清单（实测后的真实契约）、截图说明

## 测试与验收
- 测试账号：`demo` / `123456`（后端已创建，磁盘为空，可自由上传）
- 本地开发：`npm run dev -- --port 5199`（**不要占用 8080/8090/8091**）
- 构建：`npm run build` → 产物 rsync 到 `/var/www/pan-vue/`（确保 `index.html` 在根）
- 验收（必须自己执行并贴出结果）：
  1. `curl -H "Host: pan.7107.com.cn" http://127.0.0.1/app/ -o /dev/null -w "%{http_code}"` → 200
  2. 抓 `/app/` HTML 里引用的 js/css 绝对路径，逐个 curl 应为 200
  3. `curl -c /tmp/vj -H "Host: pan.7107.com.cn" -X POST -d "username=demo&password=123456" http://127.0.0.1/api/login` → code 0
  4. 用这套 cookie 走一遍上传协议，确认 `finished`/`fullPath` 正常
- npm 源用 `https://registry.npmmirror.com`；Node v22 已在 `/usr/bin/node`

## 交付
完成后回报：完成的功能清单、验收命令输出、访问地址、README 路径、遗留问题。
