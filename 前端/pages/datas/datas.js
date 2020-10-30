import {fail} from "../../dist/toast/toast";
const app = getApp()
Page({
    /*---------------------------------------页面初始数据---------------------------------------*/
    data: {
        tip: '',
        isShow: false,
        isuser: null,
        status: null,
        hidden: false,
        infPnum: '',
        infQQid: '',
        infName: '',
        infBxzt: '',
        infDnpp: '',
        infDnxh: '',
        infFlag: '',
        infGmsj: '',
        infGzlx: '',
        infJdsj: '',
        infSblx: '',
        infTime: '',
        infWxsm: '',
        infWxtp: '',
        infWcsj: '',
        infTbid: '',
        infTxtp:'',
        confirmflag: true,
        button_isuse: false,
        picker: ['一天', '三天', '五天'],
        steps: [{text: '', desc: '订单创建'},
                {text: '', desc: '成功接单'},
                {text: '', desc: '订单完成'}]
    },
    imgArray: ['https://ossweb-img.qq.com/images/lol/web201310/skin/big84000.jpg',
               'https://ossweb-img.qq.com/images/lol/web201310/skin/big84001.jpg',
               'https://ossweb-img.qq.com/images/lol/web201310/skin/big39000.jpg',
               'https://ossweb-img.qq.com/images/lol/web201310/skin/big39000.jpg'],
    swiperList: [{
        id: 0, type: 'image', url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big84000.jpg'
    }, {
        id: 1, type: 'image', url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big84001.jpg'
    }, {
        id: 2, type: 'image', url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big39000.jpg'
    }, {
        id: 3, type: 'image', url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big10001.jpg'
    }, {
        id: 4, type: 'image', url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big25011.jpg'
    }, {
        id: 5, type: 'image', url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big21016.jpg'
    }, {
        id: 6, type: 'image', url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big99008.jpg'
    }],

    /*---------------------------------------获取用户状态---------------------------------------*/
    indexGetUserStatus: function () {
        var temp_this = this
        var temp_seid = wx.getStorageSync('seid');
        var temp_pnum = wx.getStorageSync('pnum');
        console.log('[获取本地数据]手机：'+temp_pnum)
        console.log('[获取本地数据]会话：'+temp_seid)
        wx.request({
            url: 'https://fix.fyscu.com/api/onpage/index/get_status.php',
            data: {"seid": temp_seid, "pnum": temp_pnum,},
            method: 'GET',
            header: {'content-type': 'application/json'},
            success: function (res) {
                console.log("[返回用户状态]返回：",res.data)
                if (res.data === "0" 
                 || res.data === 0
                 || res.data === "") {
                    temp_this.setData({
                        isuser:1,
                        status:0
                    })
                    app.globalData.islogin=false
                } else {
                    app.globalData.islogin=true
                    var temp1 = String(res.data)
                    temp_this.setData({isuser: temp1.substr(0, 1),  status:temp1.substr(1, 1) } )
                    app.globalData.isuser=temp1.substr(0, 1)
                   console.log(temp_this.data.isuser)
                    if(temp1.substr(2, 1)=="0"){
                        wx.showToast({title: '请先完善个人信息噢', icon:'none', duration:1500})
                        wx.reLaunch({url: "/pages/setting/setting",})
                        
                    }
                }
            },
            fail: function (res) {
                console.log("[获取用户状态]没有返回当前状态")
                wx.reLaunch({url: '/pages/datas/datas',})
            }
        })
    },
        /*---------------------------------------获取用户信息---------------------------------------*/
    indexGetUserFxData: function () {
        var temp_this = this
        var temp_seid = wx.getStorageSync('seid')
        var temp_pnum = wx.getStorageSync('pnum')
        wx.request({
                url: 'https://fix.fyscu.com/api/onpage/index/get_fxdata.php',
                data: {"seid": temp_seid, "pnum": temp_pnum,},
                method: 'GET',
                header: {'content-type': 'application/json'},
                success: function (res) {
                    console.log(temp_this.data.status)
                    console.log("[获取用户信息]返回：",res.data)
                    if(temp_this.data.status=='1' 
                     ||temp_this.data.status=='2'){
                         console.log(1)
                      temp_this.setData({
                        infPnum: res.data.pnum,
                        infBxzt: res.data.bxzt,
                        infName: res.data.name,
                        infDnpp: res.data.dnpp,
                        infDnxh: res.data.dnxh,
                        infFlag: res.data.flag,
                        infGmsj: res.data.gmsj,
                        infGzlx: res.data.gzlx,
                        infJdsj: res.data.jdsj,
                        infQQid: res.data.qqid,
                        infSblx: res.data.sbzl,
                        infTime: res.data.time,
                        infWxsm: res.data.wxsm,
                        infWxtp: res.data.wxtp,
                        infWcsj: res.data.wcsj,
                        infTbid: res.data.tbid,
                        infTxtp: 'https://fix.fyscu.com/api/module/imagesup.png/'+res.data.txtp
                    })
                    // console.log(temp_this.data.infDnxh)
                    // console.log(temp_this.data.infTxtp)
                  }      
                },
                fail:function(res) {
                    console.log("[获取用户信息]没有返回用户信息")
                },
            }
        )
    },
        /*---------------------------------------关闭用户订单---------------------------------------*/
    indexPutUserChange: function (e) {
        const temp_this = this
        
        console.log('1',temp_this.data.infTbid)
        let type = parseInt(e.currentTarget.dataset.type)
        console.log(type)
        console.log(e)
        console.log(1)  
        var temp_seid = wx.getStorageSync('seid')
        var temp_pnum = wx.getStorageSync('pnum')
        // 2 用户确认完成 3用户放弃 4 技术员关闭 
        wx.request({
                url: 'https://fix.fyscu.com/api/onpage/index/get_finish.php',
                data: {"seid": temp_seid,
                        type,
                        "tbid":temp_this.data.infTbid,
                       "pnum": temp_pnum,
                       "flag": 2,},
                method: 'GET',
                header: {'content-type': 'application/json'},
                success: function (res) {
                    console.log('[确认维修完成]返回：'+JSON.stringify(res))
                    wx.reLaunch({url: '/pages/datas/datas',})
                    }
                },
            )
        wx.showToast({
            title: '成功',
            icon: 'success',
            duration: 2000
        })
        this.onPullDownRefresh()

        },
    indexPutUserGiveup: function () {
        var temp_this = this
        var temp_seid = wx.getStorageSync('seid')
        var temp_pnum = wx.getStorageSync('pnum')
        wx.request({
                url: 'https://fix.fyscu.com/api/onpage/index/get_finish.php',
                data: {"seid": temp_seid,
                       "pnum": temp_pnum,
                       "flag": 3,},
                method: 'GET',
                header: {'content-type': 'application/json'},
                success: function (res) {
                    console.log('[确认放弃维修]返回：'+res)
                }
            },
        )
        wx.showToast({
            title: '撤销成功',
            icon: 'success',
            duration: 2000
        })
        this.onPullDownRefresh()
    },
/*--------------------------------------跳转维修页面---------------------------------------*/
indexGetUserRepair:function () {
    let status
    var temp_this = this
    var temp_seid = wx.getStorageSync('seid')
    var temp_pnum = wx.getStorageSync('pnum')
    wx.showLoading({title: '加载中...'}
    )
    wx.request({
            url: `https://fix.fyscu.com/api/onpage/about/get_status.php?pnum=${temp_pnum}&seid=${temp_seid}`,
            data: {"seid": temp_seid,
                   "pnum": temp_pnum,
                   "flag": 3,},
            method: 'GET',
            header: {'content-type': 'application/json'},
            success: function (res) {
               status = res.data
               wx.hideLoading()
               if(app.globalData.islogin==false) {
                 wx.navigateTo({
                   url: '/pages/login/login', success: function (res) {
                    
                   }
               })
               }
               else{
                   console.log(status)
                   if(status==2){
                       wx.showToast({
                         title: '不好意思!当前报修已满!',
                         icon:'none',
                         duration:2000
                       })
                       return
                   }else if(status==1){
                       wx.showToast({
                           title: '你已被禁止报修!',
                           icon:'none',
                           duration:2000
                         })
                         return 
                   }else if(status==3){
                    wx.showToast({
                        title: '本周限额已满，只有会员可以报修!',
                        icon:'none',
                        duration:2000
                      })
                      return 

                   }
                   temp_this.setData({
                    isShow:true
                   })
                //    wx.showModal({
                //     title: '须知',
                //     content: '在华西或者望江校区的机主需要将电脑送来江安校区，否则技术员有权取消订单',
                //     success (res) {
                //       if (res.confirm) {
                //                wx.navigateTo({
                //                  url: '/pages/posts/posts', success: function (res) {
                //                      wx.hideLoading({
                //                     complete: (res) => {
                //                     },
                //                 })
                //             }
                //         })
                //       } else if (res.cancel) {    
                //       }
                //     }
                //   })
            
               }
            }
        },
    )

},
hidebtn(){
    this.setData({
        isShow:false
    })
},
confirm(){

    wx.navigateTo({
        url: '/pages/posts/posts', success: function (res) {
            wx.hideLoading({
           complete: (res) => {
           },
       })
    }
})
},
  
/*--------------------------------------监听页面加载---------------------------------------*/

onLoad: function (options) {
    this.indexGetUserStatus()
    if(app.globalData.islogin==false) {
      this.setData({
        isuser:1,
        status:0
      })
    }
    else{
      this.indexGetUserFxData()
    }
    
}
,
/*--------------------------------------用户下拉动作---------------------------------------*/
onPullDownRefresh: function () {
    wx.showNavigationBarLoading()
    this.onLoad()
    setTimeout(function () {
        wx.hideNavigationBarLoading()
        wx.stopPullDownRefresh()
    }, 1500);
}
,
/*--------------------------------------页面上拉触底---------------------------------------*/
onReachBottom: function () {
    if (this.data.status == 0 && this.data.isuser == 0) {
        wx.showLoading({title: '加载数据中...',})
        setTimeout(function () {
            wx.hideLoading({
                complete: (res) => {
                },
            })
        }, 1500)
    }
},
    option(){
        wx.navigateTo({
            url: '/pages/options/options',
          })
    },

    detail:function(){
    wx.showLoading({
      title: '加载中...'
    })
    wx.navigateTo({
      url: '/pages/detail/detail?infTbid='+this.data.infTbid,
      success: function (res) {
        wx.hideLoading({
          complete: (res) => {},
        })
      }
    })
  },
/*---------------------------------------------------------------------------------------*/
onShow: function () {
    this.onLoad()
},
copy:function(e) {
    console.log(e)
    wx.setClipboardData({
      data: e.currentTarget.dataset.text,
      success:function(res) {
        wx.getClipboardData({
          complete: (res) => {
          },
        })
      }
    })
  },
})