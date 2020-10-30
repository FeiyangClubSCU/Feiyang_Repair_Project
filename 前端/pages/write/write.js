// pages/writeanswer/writeanswer.js
import Toast from '../../dist/toast/toast';
Page({

  /**
   * 页面的初始数据
   */
  data: {
    isShow: false,
    answer:'',
    ssid:null,
    question:''
  },

  getanswer:function(e) {
    this.setData({
      answer:e.detail.value
    })
  },

  hidebtn: function(){
    this.setData({
      isShow: false,
    })
  },

  confirm:function() {
    if (this.data.answer == '') {
      Toast.fail('内容不能为空')
    }
    else{
      var temp_this = this
      var temp_seid = wx.getStorageSync('seid');
      var temp_pnum = wx.getStorageSync('pnum');
      console.log( "ssid",temp_this.data.ssid)
      wx.request({
        url: 'https://fix.fyscu.com/api/onpage/infos/put_newans.php',
        data: {
          "seid": temp_seid,
          "pnum": temp_pnum,
          "text": temp_this.data.answer,
          "ssid": temp_this.data.ssid,
        },
        method: 'GET',
        header: {'content-type': 'application/json'},
        success: function (res) {
          console.log('[获取反馈状态]内容：'+res.data)
        },})
      wx.showToast({
        title: '提交成功',
        icon:'success'
      })
      this.setData({
        isShow: false,
      })
    }
  },

  submit_answer:function() {
    this.setData({
      isShow: true,
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.setData({
      ssid:options.ssid,
      question:options.question
    })

  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})