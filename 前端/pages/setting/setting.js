// pages/option/option.js
import Toast from '../../dist/toast/toast';
const app = getApp()
Page({

  /**
   * 页面的初始数据
   */
  data: {
    img:'',
    picker: ['男','女'],
    QQ:'',
    sex:'',
    phone:'',
    name:'',
    email:'',
    txtp:"",
  },

  getname:function(e) {
    this.setData({
      name:e.detail.value
    })
  },

  // getsex:function(e) {
  //   let index = e.detail.value
  //   console.log(e.detail.value)
  //   if(index == 0) {
  //     this.setData({
  //       sex:'男'
  //    })
  //   } else{
  //   this.setData({
  //     sex:'女'
  //  })
  // }
  // },

  // getphone:function(e) {
  //   this.setData({
  //     phone:e.detail.value
  //   })
  // },

  // getQQ:function(e) {
  //   this.setData({
  //     QQ:e.detail.value
  //   })
  // },

  getemail:function(e) {
    this.setData({
      email:e.detail.value
    })
  },
  logout(){
    try {
      wx.clearStorageSync()
    } catch(e) {
      console.log(e)
    }
    console.log(1)
   wx.switchTab({
     url: '/pages/datas/datas',
     success(res){
       console.log(res)
     },
     fail(e){
       console.log(e)
     }
   })
  },
  submit:function(e) {
    console.log(this.data.img,this.data.email)
    this.postsPicturesReads()
    if (this.data.name == '') {
      Toast.fail('姓名为空')
      return false;
    }else if(!this.data.img ){

      Toast.fail('请选择头像')
      return false;
    }else if(!this.data.email){
      Toast.fail('请填写邮箱')
      return false;
    }
    /*
    if (this.data.sex == '') {
      Toast.fail('性别为空')
      return false;
    }
    if (this.data.phone == '') {
      Toast.fail('手机号为空')
      return false;
    }
    if (this.data.QQ == '') {
      Toast.fail('QQ号为空')
      return false;
    }
    */
    if (this.data.email == '') {
      Toast.fail('邮箱为空')
      return false;
    }
    else{
      var temp_this = this
      var temp_seid = wx.getStorageSync('seid');
      var temp_pnum = wx.getStorageSync('pnum');
      console.log(temp_seid)
      console.log(temp_pnum)
      

      wx.request({
          url: 'https://fix.fyscu.com/api/onpage/about/put_userid.php',
          data: {"seid": temp_seid, "pnum": temp_pnum,
                 "name": temp_this.data.name,
                 "mail": temp_this.data.email,
                 "txtp": temp_this.data.txtp,
                 
        },
          method: 'GET',
          header: {'content-type': 'application/json'},
          success: function (res) {
            console.log(res.data)
          },
      })
      wx.showToast({
        title:'提交成功',
        icon:'success',
        duration:1500
      }),
      wx.reLaunch({
        url: '/pages/about/about?namedata=' + this.data.name +'&phonedata=' + this.data.phone + '&sexdata=' + this.data.sex,
      })
    }
  },
  onLoad: function (options) {
    var temp_this = this
    var temp_seid = wx.getStorageSync('seid');
    var temp_pnum = wx.getStorageSync('pnum');
    console.log(temp_seid)
    console.log(temp_pnum)
    wx.request({
        url: 'https://fix.fyscu.com/api/onpage/about/get_userid.php',
        data: {"seid": temp_seid, "pnum": temp_pnum,},
        method: 'GET',
        header: {'content-type': 'application/json'},
        success: function (res) {
          console.log(res.data)
          temp_this.setData({
            email:res.data.mail,
            name:res.data.name,
            txtp:res.data.txtp,
            img:'https://fix.fyscu.com/api/module/imagesup.png/'+res.data.txtp
          })
        },
    })
  },

  PickerChange(e) {
    console.log(e);
    var indexname = e.currentTarget.id;
    if(indexname === 'interval')
    this.setData({
      intervalindex: e.detail.value
    })
    if(indexname === 'connecttype')
    this.setData({
      connecttypeindex: e.detail.value
    })
  },
  upload(){
    let that = this
    wx.chooseImage({
      count: 1, //默认9
      sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
      sourceType: ['album'], //从相册选择
      
      success: (res) => {
          this.setData({
            img: res.tempFilePaths.toString(),
            // txtp:res.tempFilePaths.toString()
          })
          // console.log('this.data.txtp',this.data.txtp)

        that.postsPicturesReads()
      }

    })


  },
      /*-------------------------------------------------------------------------------------*/
  postsPicturesReads(event) {
    var temp_this = this
    console.log("img",temp_this.data.img)
    // const { file } = event.detail;
    // 当设置 mutiple 为 true 时, file 为数组格式，否则为对象格式
    wx.uploadFile({
      url: 'https://fix.fyscu.com/api/module/uploadim.php', // 仅为示例，非真实的接口地址
      filePath: temp_this.data.img,
      name: 'file',
      formData: { user: 'test' },
      success(res) {
        console.log("success")
        console.log("res.data",res.data)
        temp_this.setData({img:("https://fix.fyscu.com/api/module/imagesup.png/"+res.data),
                           txtp:res.data,
      })
        console.log("txtpafter",temp_this.data.txtp)

        // 上传完成需要更新 fileList
        // fileList = temp_this.data.fileList
        // fileList.push({ ...file, url:  })
        // temp_this.setData({ fileList })
      },
      fail(res){
        console.log("fail")
        console.log(res.data)
      }
    })
  }
})
