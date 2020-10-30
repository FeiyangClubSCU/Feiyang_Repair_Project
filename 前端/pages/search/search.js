const app = getApp()
Page({
  data: {
    keywords:"",
    content:[],
    islogin:false
  },

  searchdetail:function(events) {
    console.log("cont",events.currentTarget.dataset.cont)
     wx.navigateTo({
       url: '/pages/content/content?ssid='+events.currentTarget.dataset.ssid+"&cont="+events.currentTarget.dataset.cont,
     })
  },
  onLoad:function(){
    this.search()
          this.setData({
          islogin:app.globalData.islogin
        })
        console.log(this.data.islogin)
  },
  search:function(events) {
    var temp_this = this 
    wx.request({
      url: 'https://fix.fyscu.com/api/onpage/infos/get_search.php',
      data: {
           "tips": temp_this.data.keywords
      },
      method: 'GET',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        console.log(res)
        let arrlist 
        console.log(arrlist)
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
        temp_this.setData({
          content:content,
        })
        console.log("content", temp_this.data.content)

      },
      fail: function (res) {
        console.log("[获取用户状态]没有返回当前状态")
        wx.showModal({
          title: '获取用户状态失败',
          content: res.data,
        })
      },
    })
    this.setData({
      keywords:''
    })
  },
  inputchange: function(e){
    let that = this 
    let value = e.detail.value
    this.setData({
      keywords:value
    })
  },
  onPullDownRefresh: function () {
    wx.showNavigationBarLoading()
    this.onLoad()
    setTimeout(function(){
      wx.hideNavigationBarLoading()
      wx.stopPullDownRefresh()
    },1500);
  },
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
})