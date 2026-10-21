# 部署说明

## 组成

| 组件 | 说明 | 端口 |
|---|---|---|
| `pan-vue` | Vue3 前端静态站（本仓库主体） | 由 nginx 直接提供，`base=/app/` |
| `pan-web` | 后端 PHP7 + Apache 容器（第三方 ModStart 网盘） | 127.0.0.1:8088 |
| `pan-db` | MySQL 5.6 容器（库 `cs`，37 张表） | 127.0.0.1:3317 |

前端与后端**同源部署**：`https://pan.x6m.top/app/` 是前端，`https://pan.x6m.top/api/*` 由 nginx 反代到 8088，因此鉴权直接用 cookie session，无跨域问题。

## 步骤

```bash
# 1. 构建前端
npm install --registry=https://registry.npmmirror.com
npm run build
rsync -a --delete dist/ /var/www/pan-vue/

# 2. 起后端（需自备 ModStart 网盘源码，见下方说明）
cd /opt/pan-deploy && docker compose up -d

# 3. nginx
cp deploy/nginx-pan.conf /etc/nginx/sites-enabled/
/usr/sbin/nginx -t && systemctl restart nginx

# 4. HTTPS
certbot certonly --webroot -w /var/www/acme -d pan.x6m.top
```

## 说明

- 后端为第三方商业 CMS（bygoukai ModStart 网盘系统），源码不在本仓库内，仅提供 `deploy/` 下的容器封装与 `database/schema.sql` 表结构。
- 数据库表结构见 `database/schema.sql`（37 张表，无数据）。
- 数据结构设计说明见 `docs/database-design.md`。
