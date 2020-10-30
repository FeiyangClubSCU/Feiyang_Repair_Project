// pages/history/history.js
Page({
  data: {
    loading: true,
    tempdat: null,
    history: [],
  },
  detail: function (details) {
    console.log(details.currentTarget.dataset.inftbid)
    wx.showLoading({
      title: '加载中...'
    })
    wx.navigateTo({
      url: '/pages/detail/detail?infTbid='+details.currentTarget.dataset.inftbid,
      success: function (res) {
        wx.hideLoading({
          complete: (res) => {},
        })
      }
    })
  },
  onLoad: function (options) {
    var temp_this = this
    var temp_seid = wx.getStorageSync('seid')
    var temp_pnum = wx.getStorageSync('pnum')
    wx.request({
      url: 'https://fix.fyscu.com/api/onpage/about/get_history.php',
       data: {
         "seid": temp_seid,
         "pnum": temp_pnum,
      },
      method: 'GET',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        let arrlist
        // console.log(JSON.stringify(res.data))
         console.log(JSON.stringify(res))
        console.log(typeof(res.data))
        if(typeof(res.data)=="string"){
          arrlist = (res.data).split("`")
        }else{
          arrlist = JSON.stringify(res.data).split("`")
        }
        console.log(arrlist)
        let history = arrlist.map(item => {
          let temp = JSON.parse(item)
          temp["time"] = temp["time"].substr(0, 10)
          temp["txtp"] = 'https://fix.fyscu.com/api/module/imagesup.png/'+temp["txtp"]
          return temp
        })
        let arrlist1 = []
        history.forEach(item=>{
          arrlist1.unshift(item)
        })
        console.log("his",arrlist1)
        temp_this.setData({
          history:arrlist1,
        })
          temp_this.setData({
           tempdat:res.data
        })
        console.log(temp_this.data.history)
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

  /* 页面相关事件处理函数--监听用户下拉动作*/
  onPullDownRefresh: function () {
    wx.showNavigationBarLoading()
    this.onLoad()
    setTimeout(function () {
      wx.hideNavigationBarLoading()
      wx.stopPullDownRefresh()
    }, 1500);
  },

  /* 页面上拉触底事件的处理函数*/
  onReachBottom: function () {
    wx.showLoading({
      title: '加载数据中...',
    })
    setTimeout(function () {
      wx.hideLoading({
        complete: (res) => {},
      })
    }, 1500)
  },
})