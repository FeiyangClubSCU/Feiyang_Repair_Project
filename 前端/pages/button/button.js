let app =  getApp()
Component({
  data: {
    isshow:false,
    animationPlus:{},
    animationAsk:{},
    animationAnswer:{}
  },
  properties: {
    islogin:{
      type:Boolean
    }
  },methods:{
    
    ask:function() {
      wx.showLoading({
        title: '加载中...',
      })
      wx.navigateTo({
        url: '/pages/ask/ask',
        success:function(res) {
          wx.hideLoading({
            complete: (res) => {},
          })
        }
      })
    },
    answer:function() {
      console.log(this.data.islogin)
      wx.showLoading({
        title: '加载中...',
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
        
      }else{
        wx.navigateTo({
          url: '/pages/answer/answer',
          success:function(res) {
            wx.hideLoading({
              complete: (res) => {},
            })
          }
        })
      }
  
    },

    // showOrHide:function(){
    //    var that = this;
    //  // 创建一个动画实例
    // // 当没有出菜单时
     
    // if(that.data.isshow === false){
      
    //   that.data.isshow = true;
    //   console.log(that.data.isshow)
    //   that.show();
    // }
    // // 当菜单已经出现
    // else if(that.data.isshow === true){
    //   console.log("click")
    //   that.data.isshow = false;
    //   that.hide();
    // }
    // }
    // ,
    // show: function(){
      
    //   var animationPlus = wx.createAnimation({
    //     duration: 500,
    //     timingFunction: 'ease-out'
    //   })
    //   var animationAsk = wx.createAnimation({
    //     duration: 500,
    //     timingFunction: 'ease-out'
    //   })
    //   var animationAnswer = wx.createAnimation({
    //     duration: 500,
    //     timingFunction: 'ease-out'
    //   })
    //     // 加号变× answer 最上 - ask
    //     // px与rpx之间转换的公式：px = rpx / 750 * wx.getSystemInfoSync().windowWidth;
    //     animationPlus.rotateZ(45).step();
    //     animationAsk.translateY(-( 110 / 750 * wx.getSystemInfoSync().windowWidth)).step();
    //     animationAnswer.translateY(-( 220 / 750 * wx.getSystemInfoSync().windowWidth)).step();
    //     this.setData({
    //       animationPlus: animationPlus.export(),
    //       animationAsk: animationAsk.export(),
    //       animationAnswer: animationAnswer.export()
    //     })
    // },
    // hide: function(){
    //   var animationPlus =  wx.createAnimation({
    //     duration: 500,
    //     timingFunction: 'ease-out'
    //   })
    //   var animationAnswer = wx.createAnimation({
    //     duration: 500,
    //     timingFunction: 'ease-out'
    //   })
    //   var animationAsk = wx.createAnimation({
    //     duration: 500,
    //     timingFunction: 'ease-out'
    //   })
    //     // 加号变× home 最上 - File - User
    //     // px与rpx之间转换的公式：px = rpx / 750 * wx.getSystemInfoSync().windowWidth;
    //     animationPlus.rotateZ(0).step();
    //     animationAsk.translate(0).step();
    //     animationAnswer.translateY(0).step();
    //     this.setData({
    //       animationPlus: animationPlus.export(),
    //       animationAsk: animationAsk.export(),
    //       animationAnswer: animationAnswer.export()
    //     })
    // }
  }

})