Page({
  data: {
    imgArray:[],
    swiperList: [{id: 0,type: 'image',url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big84000.jpg'},
                 {id: 1,type: 'image',url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big84001.jpg'},
                 {id: 2,type: 'image',url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big39000.jpg'},
                 {id: 3,type: 'image',url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big10001.jpg'},
                 {id: 4,type: 'image',url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big25011.jpg'},
                 {id: 5,type: 'image',url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big21016.jpg'},
                 {id: 6,type: 'image',url: 'https://ossweb-img.qq.com/images/lol/web201310/skin/big99008.jpg'}],
    infPnum: '',
    infBxzt: '',
    infName: '',
    infDnpp: '',
    infDnxh: '',
    infFlag: '',
    infGmsj: '',
    infGzlx: '',
    infJdsj: '',
    infQQid: '',
    infSblx: '',
    infTime: '',
    infWxsm: '',
    infWxtp: '',
    infWcsj: '',
    infTbid: null,
  },
  /*---------------------------------------获取用户信息---------------------------------------*/
  detailGetUserFxData: function () {
  },
  onLoad:function(options){
    this.setData({
      infTbid:options.infTbid
    })
    var temp_this = this
    var temp_seid = wx.getStorageSync('seid')
    var temp_pnum = wx.getStorageSync('pnum')
    wx.request({
      url: 'https://fix.fyscu.com/api/onpage/about/get_detail.php',
      data: {
      "seid": temp_seid,
      "pnum": temp_pnum,
      "tbid": temp_this.data.infTbid
      },
      method: 'GET',
      header: {
        'content-type': 'application/json'
      },
      success: function (res) {
        console.log("data",res.data)
        if(res.data!='0'){
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
            infWxtp: "https://fix.fyscu.com/api/module/imagesup.png/"+res.data.wxtp,
            infWcsj: res.data.wcsj,
          })
        }
        if(res.data.wxtp){
        temp_this.setData({
          'imgArray[0]':temp_this.data.infWxtp
        })
      }
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
  copy: function (e) {
    console.log(e)
    wx.setClipboardData({
      data: e.currentTarget.dataset.text,
      success: function (res) {
        wx.getClipboardData({
          complete: (res) => {},
        })
      }
    })
  },
  previewImg: function (event) {
    console.log(event.currentTarget.dataset.src)
    var src = event.currentTarget.dataset.src; //获取data-src
    var imgList = event.currentTarget.dataset.list; //获取data-list
    wx.previewImage({
      current: src, // 当前显示图片的http链接
      urls: imgList // 需要预览的图片http链接列表
    })
  },
})