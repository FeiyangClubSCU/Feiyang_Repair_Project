// pages/fixform/fixform.js
import Toast from '../../dist/toast/toast';
Page({
  data: {
    devType:['戴尔DELL','苹果Apple','华为HUAWEI','联想 Lenovo','华硕 ASUS',
             '神舟HASEE','三星Samsung','微软Microsoft','惠普HP','宏碁Acer',
             '雷蛇Razer','ThinkPad','外星人Alienware','雷神Thunder','NEC',
             '机械师MACHENIKE','微星Msi','炫龙Shinelon','清华同方','Intel',
             '技嘉GIGABYTE','海尔Haier','LG','东芝Toshiba','松下 Panasonic',
             'Terrans Force','富士通FUJITSU','爱尔轩AIERXUAN','酷比魔方CUBE',
             '锡恩帝CENDE','海鲅HIPAA','索立信','夏普Sharp','SO-SOON','其他'],
    insType: ['过保','在保','未知'],
    tolType: ['笔记本(Laptop)','台式机(PC/Mac)',
              '移动电话(Mobile Phone)','其他设备(Other)'],
    fixType: ['设备清灰','系统重装','无法开机','设备进水','软件问题'],
    campusType:['江安校区','华西校区','望江校区'],
    insSelt: null,
    campusSel:null,
    devSelt: null,
    tolSelt: null,
    fixSelt: null,
    dateSelt:null,
    disShow: false,
    putQQid:'',
    xinghao:'',
    Details:'',
    uploads:'',
    fileList: []
  },
  onLoad(){
    const formatTime = date => {
      const year = date.getFullYear()
      const month = date.getMonth() + 1
      const day = date.getDate()
      return [year, month, day].map(formatNumber).join('-')
    }
    const formatNumber = n => {
      n = n.toString()
      return n[1] ? n : '0' + n
    }
    let today = formatTime(new Date())
    this.setData({
      today,
      buyDate:today
    })
  },
  /*-----------------------------可选择的输入框--------------------------------*/
  PickerChange(e) {
    console.log(e);
    var indexname = e.currentTarget.id;
    if(indexname)
    if (indexname === 'insType') this.setData({insSelt: e.detail.value})
    if (indexname === 'tolType') this.setData({tolSelt: e.detail.value})
    if (indexname === 'devType') this.setData({devSelt: e.detail.value})
    if (indexname === 'fixType') this.setData({fixSelt: e.detail.value})
    if (indexname === 'dateType') this.setData({buyDate: e.detail.value})
    if (indexname === 'campus') this.setData({campusSelt: e.detail.value})
  },
  /*-----------------------------自行输入的输入框-------------------------------*/
  getPutQQid:function(e) {this.setData({putQQid:e.detail.value})},
  getXinghao:function(e) {this.setData({xinghao:e.detail.value})},
   getBuyDate:function(e) {this.setData({buyDate:e.detail.value})},
  getDetails:function(e) {this.setData({Details:e.detail.value})},

  /*---------------------------------------------------------------------------*/
  // 提交按钮
  submit:function() {
    let that = this
    if (this.data.putQQid === '' ) {Toast.fail('QQ号为空');return false;}
    if (this.data.campusSelt === '' ) {Toast.fail('请选择校区');return false;}
    if (this.data.insSelt == null) {Toast.fail('类型为空');return false;}
    if (this.data.devType == null) {Toast.fail('品牌为空');return false;}
    if (this.data.xinghao === '' ) {Toast.fail('型号为空');return false;}
    if (this.data.buyDate === null ) {Toast.fail('购买日期');return false;}
    if (this.data.insType == null) {Toast.fail('报修状态');return false;}
    if (this.data.Details === '')  {Toast.fail('设备问题');return false;}
    if (this.data.fixType == null) {Toast.fail('故障原因');return false;}
    if(this.data.campusSelt != 0){
                   wx.showModal({
                    title: '须知',
                    content: '在华西或者望江校区的机主需要将电脑送来江安校区，否则技术员有权取消订单',
                    success (res) {
                      if (res.confirm) {
                        that.postsPutUserRepair()
                        console.log("其他小区确认")
                        return;
                      } else if (res.cancel) {    
                        console.log("其他小区取消")
                        return;
                      }
                    }
                  })
    }else{
      that.postsPutUserRepair()
    }
  },

  /*---------------------------------------------------------------------------------------*/
  postsPutUserRepair:function(){
    var temp_this = this
    var temp_seid = wx.getStorageSync('seid');
    var temp_pnum = wx.getStorageSync('pnum');
    console.log(temp_seid)
    console.log(temp_pnum)
    console.log(this.data.buyDate)
    wx.request({
      url: 'https://fix.fyscu.com/api/onpage/posts/put_repair.php',
      data: {
        "seid": temp_seid,
        "pnum": temp_pnum,
        "sblx": temp_this.data.tolType[temp_this.data.tolSelt],
        "dnpp": temp_this.data.devType[temp_this.data.devSelt],
        "bxzt": temp_this.data.insType[temp_this.data.insSelt],
        "gzlx": temp_this.data.fixType[temp_this.data.fixSelt],
        "dnxh": temp_this.data.xinghao,
        "wxsm": temp_this.data.Details,
        "qqid": temp_this.data.putQQid,
        "wxtp": temp_this.data.uploads,
        "gmsj": temp_this.data.buyDate,
      },
      method: 'GET',
      header: {'content-type': 'application/json'},
      success: function (res) {
        console.log(res.data)
        if(res.data!=="1" ) {wx.reLaunch({url: '/pages/datas/datas',})}
        else {wx.reLaunch({url: '/pages/login/login',})}},
      fail: function (res) {
        console.log("[获取返回状态]没有返回当前状态")
        wx.showModal({
          title: '获取返回状态失败',
          content: res.data,})
        wx.reLaunch({url: '/pages/login/login',})}})
   },
  /*-------------------------------------------------------------------------------------*/
  postsPicturesReads(event) {
    var temp_this = this
    const { file } = event.detail;
    // 当设置 mutiple 为 true 时, file 为数组格式，否则为对象格式
    wx.uploadFile({
      url: 'https://fix.fyscu.com/api/module/uploadim.php', // 仅为示例，非真实的接口地址
      filePath: file.path,
      name: 'file',
      formData: { user: 'test' },
      success(res) {
        console.log(res.data)
        temp_this.setData({uploads:res.data})
        // 上传完成需要更新 fileList
        let fileList = []
        fileList = temp_this.data.fileList
        fileList.push({ ...file, url: "https://fix.fyscu.com/api/module/imagesup.png/"+res.data })
        temp_this.setData({ fileList })
      }
    });
  },
  /*-------------------------------------------------------------------------------------*/
  postsBottonHidebtn: function(){this.setData({disShow: false,})},
  /*-------------------------------------------------------------------------------------*/
  postsBottonConfirm:function() {
      wx.showToast({title: '提交成功', icon:'success'})
      this.setData({disShow: false,})
      wx.showLoading({title: '加载中...'})
      wx.reLaunch({
        url: '/pages/datas/datas?status=1',
        success:function(res) {
          wx.hideLoading({
            complete: (res) => {},
          })
        }
      })
  },
  /*-------------------------------------------------------------------------------------*/
})