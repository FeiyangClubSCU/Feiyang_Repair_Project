// pages/searchdetail/searchdetail.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    ssids:{},
    answers:[],
    people:0,
    disabled:false,
    isShow:false,
    loading:false,
    wzbt:'',
    nowssid:''
  },

  approve:function(e) {
    let that = this
    console.log(e)
    console.log(this.data.ssids[e.currentTarget.dataset.ssid]['approve'])
    let ssids = this.data.ssids
    wx.request({
      url: 'https://fix.fyscu.com/api/onpage/infos/put_onstar.php?ssid='+e.currentTarget.dataset.ssid,
      method: 'GET',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        ssids[e.currentTarget.dataset.ssid]['approve'] = ssids[e.currentTarget.dataset.ssid]['approve']+1
        ssids[e.currentTarget.dataset.ssid]['disable'] = true
          that.setData({
            ssids:ssids,     
          })
            wx.showToast({

                  title:"点赞成功",       
            
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
  
  answer:function(events) {
    wx.showToast({
      title: '回答功能正在加急搭建中！',
      icon:'none'
    })
    // wx.showLoading({
    //   title: '加载中...',
    // })
    // console.log(this.data.nowssid)
    // wx.navigateTo({
    //   url: '/pages/write/write?ssid='+this.data.nowssid+"&question="+this.data.wzbt,
    //   success:function(res) {
    //     wx.hideLoading({
    //       complete: (res) => {},
    //     })
    //   }
    // })
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
      
      var temp_this = this
      var temp = []
      console.log(options.cont)
      let conts=[]
      if(options.cont!=="null"){
        console.log(options.cont)
         conts = options.cont.split(",")
      }

      this.setData({
        nowssid:options.ssid
      })
      conts.unshift(options.ssid)
      conts = Array.from(new Set(conts))
      console.log("conts",conts)
      temp = conts.map(item=>{
        console.log("item",item)
        wx.request({
          url: 'https://fix.fyscu.com/api/onpage/infos/get_detail.php?ssid='+item,
          // data: {
          //      "ssid": item
          // },
          method: 'GET',
          header: {
            'content-type': 'application/json'
          },
          success: function (res) {
            console.log("res.data21",res.data)       
            // let answer = JSON.parse(res.data)
            console.log(res.data["date"])
            res.data["date"] = res.data["date"].substr(0, 10)
            console.log("res.data[txtp]",res.data["txtp"])
            res.data["txtp"] = 'https://fix.fyscu.com/api/module/imagesup.png/'+res.data["txtp"]
            //  temp_this.answers.push(res.data) 
            let tempd = temp_this.data.answers
            let ssids = temp_this.data.ssids
            // res.data['ssid'].push
            let ssidtemp = res.data['ssid']
            tempd.push(res.data)
            ssids[ssidtemp] = {'disable':false,'approve':parseInt(res.data.good)}
            // ssids.add(ssidtemp:)
            temp_this.setData({
              answers:tempd,
              ssids:ssids,
              wzbt:res.data['wzbt']
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
 
      })

      // })
      console.log("answers",temp_this.data.answers)


      


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