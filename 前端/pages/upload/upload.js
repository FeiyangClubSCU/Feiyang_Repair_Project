// pages/question/question.js
import Toast from '../../dist/toast/toast';
Page({

  /**
   * 页面的初始数据
   */
  data: {
    question:'',
    isShow: false
  },

  getquestion:function(e) {
    this.setData({
      question:e.detail.value
    })
  },

  return:function(){
    this.setData({
      isShow: true,
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

  },

  hidebtn: function(){
    this.setData({
      isShow: false,
    })
  },

  confirm:function() {
    var temp_this = this
    var temp_seid = wx.getStorageSync('seid');
    var temp_pnum = wx.getStorageSync('pnum');
    if (this.data.question == '') {
      Toast.fail('内容不能为空')
    }
    else{
      wx.request({
        url: 'https://fix.fyscu.com/api/onpage/about/put_feedback.php',
        data: {
          "seid": temp_seid,
          "pnum": temp_pnum,
          "text": temp_this.data.question,
        },
        method: 'GET',
        header: {'content-type': 'application/json'},
        success: function (res) {
          console.log('[获取反馈状态]内容：'+res.data)
        },})
      wx.showToast({
        title: '反馈成功',
        icon:'success'
      })
      this.setData({
        isShow: false,
      })
    }
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