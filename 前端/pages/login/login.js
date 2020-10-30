import {fail} from "../../dist/toast/toast";
const app = getApp()
Page({

  /*---------------------------------------页面初始化---------------------------------------*/
  data: {
    loginDataPnum:'',
    loginDataCode:'',
    LoginDataFlag: null,
    LoginDataData: '',
    loginNameCode:'获取',
    disabled:false,
  },
  /*---------------------------------------获取输入值---------------------------------------*/
  loginGetPnumValue:function(e) {this.setData({loginDataPnum:e.detail.value})},
  loginGetCodeValue:function(e) {this.setData({loginDataCode:e.detail.value})},
  /*---------------------------------------获取验证码---------------------------------------*/
  loginGetCodeBotto:function() {
    var temp_this = this;
    var temp_rule = /^(13[0-9]|14[0-9]|15[0-9]|16[0-9]|17[0-9]|18[0-9]|19[0-9])\d{8}$/
    if (this.data.loginDataPnum === '') {
      wx.showToast({title: '手机号不能为空', icon:'none', duration:1500});return false;}
    else if (!temp_rule.test(this.data.loginDataPnum)) {
      wx.showToast({title: '手机号输入有误', icon:'none', duration:1500});return false;}
    else {
      wx.request({
        data:{'pnum':temp_this.data.loginDataPnum,},
        url: 'https://fix.fyscu.com/api/onpage/login/get_pncode.php',
        success:function(res) {
          var temp_nums = 60;
          temp_this.setData({disabled:true})
          var temp_time = setInterval(function() {
              temp_nums--;
              if (temp_nums <= 0) {
                clearInterval(temp_time);
                temp_this.setData({loginNameCode:'重新发送', disabled:false})}
              else {temp_this.setData({loginNameCode:temp_nums + 's'})}},1000)
        },
        fail:function(res){
          console.log("[获取短信验证]无法获取短信验证")
          wx.showModal({
            title: '获取失败',
            content: res.data,}
          )}
        }
      )
    }
  },
  /*---------------------------------------校验验证码---------------------------------------*/
  toKnow(){
    wx.navigateTo({
      url: '/pages/start/start',
      success:function(res) {
        wx.hideLoading({
          complete: (res) => {},
        })
      }
    })

  },

  loginGetCodeCheck(){
    var temp_rule = /^(13[0-9]|14[0-9]|15[0-9]|16[0-9]|17[0-9]|18[0-9]|19[0-9])\d{8}$/
    var temp_this = this;
    if (this.data.loginDataPnum === '') {
      wx.showToast({title: '手机号不能为空', icon:'none', duration:1500});return false;}
    else if (!temp_rule.test(this.data.loginDataPnum)) {
      wx.showToast({title: '手机号输入有误', icon:'none', duration:1500});return false;}
      if (this.data.loginDataCode === '') {
        wx.showToast({title: '验证码不能为空', icon:'none', duration:1500});return false;}
    wx.request({
          data:{'pnum':temp_this.data.loginDataPnum,
                'code':temp_this.data.loginDataCode,
          },
          url: 'https://fix.fyscu.com/api/onpage/login/get_verify.php',
          success:function(res) {
            temp_this.setData({loginDataFlag:res.data})
            if (res.data!="0") {
              console.log("[获取登录校验]校验通过")
              console.log(res.data)
              wx.setStorageSync('seid', res.data)
              wx.setStorageSync('pnum', temp_this.data.loginDataPnum)
              app.globalData.islogin=true
              wx.reLaunch({url: '/pages/datas/datas',})
            } else {
              console.log("[获取登录校验]校验失败")
              wx.showToast({title: '验证码错误', icon:'none', duration:1500});return false;
            }
          },
          fail:function(res){
         
            console.log("[获取登录校验]无法获取登录校验")
            wx.showModal({
              title: '校验失败',
              content: res.data,}
            )}
        }
    )
  },
  /*----------------------------------------------------------------------------------------*/
})