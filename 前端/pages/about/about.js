// pages/about/about.js
const app = getApp()
Page({
  data: {
    img:'',
    show: false,
    isuser:'',
    name:'',
    sex:'',
    phone:'',
    txtp:'',
    islogin:false
  },
  history:function(e) {
    wx.showLoading({
      title: '加载中...'
    })
    if(this.data.islogin==false) {
      wx.navigateTo({
        url: '/pages/login/login', success: function (res) {
            wx.hideLoading({
                complete: (res) => {
                },
            })
        }
    })
    }
    else{
    wx.navigateTo({
      url: '/pages/history/history',
      success:function(res) {
        wx.hideLoading({
          complete: (res) => {},
        })
      }
    })
  }
  },

  personinfo:function() {
    wx.showLoading({
      title: '加载中...'
    })
    if(this.data.islogin==false) {
      wx.navigateTo({
        url: '/pages/login/login', success: function (res) {
            wx.hideLoading({
                complete: (res) => {
                },
            })
        }
    })
    }
    else{
    wx.navigateTo({
      url: '/pages/setting/setting',
      success:function(res) {
        wx.hideLoading({
          complete: (res) => {},
        })
      }
    })
  }
  },

  question:function() {
    wx.showLoading({
      title: '加载中...'
    })

  
    wx.navigateTo({
      url: '/pages/upload/upload',
      success:function(res) {
        wx.hideLoading({
          complete: (res) => {},
        })
      }
    })
  
  },
  toLogin:function () {
    wx.showLoading({title: '加载中...'})
    if(this.data.islogin==false) {
      wx.navigateTo({
        url: '/pages/login/login', success: function (res) {
            wx.hideLoading({
                complete: (res) => {
                },
            })
        }
    })
    }
}
,
onShow: function () {
  this.onLoad()
},
  program:function() {
    wx.showLoading({
      title: '加载中...'
    })
    wx.navigateTo({
      url: '/pages/program/program',
      success:function(res) {
        wx.hideLoading({
          complete: (res) => {},
        })
      }
    })
  
  },
  onLoad: function (options) {
    var temp_this = this
    var temp_seid = wx.getStorageSync('seid');
    var temp_pnum = wx.getStorageSync('pnum');
    console.log( app.globalData.isuser)
   
    this.setData({

      islogin:app.globalData.islogin
      })
      // userOrTec:app.globalData.isuser,
    wx.request({
        url: 'https://fix.fyscu.com/api/onpage/about/get_userid.php',
        data: {"seid": temp_seid, "pnum": temp_pnum,},
        method: 'GET',
        header: {'content-type': 'application/json'},
        success: function (res) {
          if(res.data!="0"
           &&res.data!=0){
            console.log("[获取用户信息]返回：",res.data)
            temp_this.setData({
              isuser:res.data.fixs,
              name:res.data.name,
              phone:res.data.pnum,
              txtp:res.data.txtp,
              img:'https://fix.fyscu.com/api/module/imagesup.png/'+res.data.txtp
            })
           }

        },
    })
  }
})
