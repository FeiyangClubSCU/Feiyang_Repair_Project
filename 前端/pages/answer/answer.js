// pages/answer/answer.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    quesitons:{},
    isShow:false,
    loading:false,
    ssid:null,//请求回答的ssid
    text:null,//请求回答的内容
  },

  writeanswer:function(events) {

    wx.showLoading({
      title: '加载中...',
    })
    console.log(events.currentTarget.dataset)
    wx.navigateTo({
      url: '/pages/write/write?ssid='+events.currentTarget.dataset.ssid+"&question="+events.currentTarget.dataset.question,
      success:function(res) {
        wx.hideLoading({
          complete: (res) => {},
        })
      }
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad:function(){
    this.search()
  },
  search:function(events) {
    var temp_this = this 
    wx.request({
      url: 'https://fix.fyscu.com/api/onpage/infos/get_inlist.php',
      method: 'GET',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        console.log(res)
        let arrlist
        if(typeof(res.data)=="string"){
          arrlist = (res.data).split("`")
        }else{
          arrlist = JSON.stringify(res.data).split("`")
        }
        let content = arrlist.map(item => {
          let temp = JSON.parse(item)
          temp["date"] = temp["date"].substr(0, 10)
          temp["txtp"] = 'https://fix.fyscu.com/api/module/imagesup.png/'+temp["txtp"]
          return temp
        })
        console.log("content", content)
        
        temp_this.setData({
          quesitons:content

        })

      },
      fail: function (res) {
        console.log("[获取用户状态]没有返回当前状态")
        wx.showModal({
          title: '获取用户状态失败',
          content: res.data,
        })
      },
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
    wx.showNavigationBarLoading()
    this.onLoad()
    setTimeout(function(){
      wx.hideNavigationBarLoading()
      wx.stopPullDownRefresh()
    },1500);
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
    wx.showLoading({
      title: '加载数据中...',
    })
    setTimeout(function(){
      wx.hideLoading({
        complete: (res) => {},
      })
    },1500)
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})