# 若萱云盘 · 后端

课程实训项目「网盘系统」的**后端部分**，与 [`ruoxuan-pan`](https://github.com/shenzhixvn/ruoxuan-pan)（Vue3 前端）配套使用。

## 说明

- 后端基于 **ModStart**（Laravel 5.5 内核）二次开发，运行环境 PHP 7.0 + MySQL 5.6。
- 业务能力集中在 `module/Pan`（网盘核心模块：文件/目录、上传分片、回收站、配额、分享），
  其余 `module/*` 为系统自带模块（会员、文章、导航、Banner、后台管理等）。
- 前端（Vue3 + Vite + Pinia + Element Plus）已重写并独立部署，仅通过 `/api` 与后端通信；
  **本次提交不改动后端业务逻辑**，仅归档后端代码用于实训验收与部署复现。
- 数据库共 37 张表，建表语句见前端仓库 `database/schema.sql`。

## 目录

```
backend/
├── app/            应用层（Admin/Api/Web 控制器、常量、异常）
├── bootstrap/
├── config/         Laravel 配置
├── database/       迁移与种子
├── module/         ModStart 模块（Pan = 网盘核心）
├── public/         入口与静态资源
├── resources/      视图与语言包
├── artisan
├── env.example     环境变量样例
└── 部署教程.txt     原始部署步骤
```

## 部署

1. PHP 7.0 + MySQL 5.6，扩展：exif、fileinfo、gd
2. `cp env.example .env`，填 `DB_*` 与 `APP_KEY`
3. 导入数据库（37 表）
4. Web 根目录指向 `public/`，配置伪静态
5. 后台入口 `/dome`，前台入口 `/`

## 未包含

`vendor/`（Composer 依赖）、`storage/`、`.env`、数据库导出、上传文件，均按 `.gitignore` 排除。
