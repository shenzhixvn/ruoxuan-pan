import request, { toForm } from './request'

/** 登录（当前后端 loginCaptchaEnable 关闭，captcha 字段可留空） */
export function login(username, password, captcha) {
  // silent: 登录失败由登录页内联提示，避免全局弹窗打断表单输入
  return request.post('/login', toForm({ username, password, captcha }), { silent: true })
}

/** 退出登录 */
export function logout() {
  return request.get('/logout')
}

/** 登录验证码（备用分支） */
export function getLoginCaptcha() {
  return request.get('/login_captcha', { silent: true })
}

/** 修改密码：实测入参 passwordOld / passwordNew / passwordRepeat */
export function changePassword({ passwordOld, passwordNew, passwordRepeat }) {
  return request.post('/member_profile/password', toForm({ passwordOld, passwordNew, passwordRepeat }), {
    silent: true
  })
}
