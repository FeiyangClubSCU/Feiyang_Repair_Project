// pages/options/options.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    day: [1, 2, 3, 4, 5, 6, 7]
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    let that = this
    var temp_seid = wx.getStorageSync('seid');
    var temp_pnum = wx.getStorageSync('pnum');
    wx.showLoading({
      title: '加载中',
    })
    wx.request({
      url: `https://fix.fyscu.com/api/onpage/index/get_wxsets.php?pnum=${temp_pnum}&seid=${temp_seid}`,
      data: {
        "seid": temp_seid,
        "pnum": temp_pnum,
        "flag": 3,
      },
      method: 'GET',
      header: { 'content-type': 'application/json' },
      success: function (res) {
        wx.hideLoading()
        let json = JSON.parse(JSON.stringify(res.data))
        let _next = parseInt(json.next)
        let aval = parseInt(json.aval)
        let qqky = parseInt(json.qqky)
        let qqid = json.qqid
        let index 
        if(_next == 0){
          index = 0
        }else{
          index = _next - 1
        }
        console.log(index)
        console.log(JSON.stringify(res.data))
        that.setData({
          index,
          aval,
          qqky,
          qqid
        })


      }
    },
    )
  },
  PickerChange(e) {

    this.setData({
      index: e.detail.value
    })
  },
  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },
  inputchange(e) {

    switch (e.currentTarget.dataset.type) {
      case "qqky":
        this.setData({
          qqky: e.detail.value ? 1 : 0
        })
        break;
      case "aval":
        this.setData({
          aval: e.detail.value ? 1 :0
        })
        break;
      case "qqid":
        this.setData({
          qqid: e.detail.value
        })
        break;

    }

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

  },
  submit() {
    var temp_seid = wx.getStorageSync('seid');
    var temp_pnum = wx.getStorageSync('pnum');
    console.log(this.data.day[this.data.index], this.data.aval, this.data.qqky, this.data.qqid);
    if (parseInt(this.data.qqky) && (!this.data.qqid)) {
      console.log("请输入qq号码");
      wx.showToast({
        title: '请输入qq号码',
        icon: 'none',
        duration: 2000
      })
     return
    }
    wx.showLoading({
      title: '提交中',
    })
    wx.request({
       url: `https://fix.fyscu.com/api/onpage/index/put_wxsets.php?pnum=${temp_pnum}&seid=${temp_seid}&next=${this.data.day[this.data.index]}&aval=${this.data.aval}&qqky=${this.data.qqky}&qqid=${this.data.qqid}&sets=0`,
       data: {
        "seid": temp_seid,
        "pnum": temp_pnum,
        "flag": 3,
      },
      method: 'GET',
      header: { 'content-type': 'application/json' },
      success: function (res) {
        console.log(res)
        wx.hideLoading()
        wx.showToast({
          title: '提交成功!',
        })

      }
    },
    )
    // https://fix.fyscu.com/api/onpage/index/put_wxsets.php?pnum=15998977068&seid=70395038409796&next=100&aval=1&qqky=1&qqid=894662978&sets=0
      
  }

})