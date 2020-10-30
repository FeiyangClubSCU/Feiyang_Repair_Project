const app = getApp()
Page({
    /*---------------------------------------页面初始数据---------------------------------------*/
    data: {startNoticeText: '暂无公告'},
    /*---------------------------------------监听页面加载---------------------------------------*/
    onLoad: function () {this.startGetNotice();},
    /*---------------------------------------跳转登录界面---------------------------------------*/
    startGoToLogin: function () {wx.reLaunch({url: '/pages/login/login',})},
    startGoToIndex: function () {wx.reLaunch({url: '/pages/datas/datas',})},
    /*---------------------------------------判断登录情况---------------------------------------*/
    startGetStatus: function () {
        try{
            var temp_seid = wx.getStorageSync('seid');
            var temp_pnum = wx.getStorageSync('pnum');
            var temp_this = this;
            console.log('[获取本地数据]手机：'+temp_pnum)
            console.log('[获取本地数据]会话：'+temp_seid)
            wx.request({
                url: 'https://fix.fyscu.com/api/onpage/start/get_status.php',
                data: {
                    "seid": temp_seid,
                    "pnum": temp_pnum,
                },
                method: 'GET',
                header: {'content-type': 'application/json'},
                success: function (res) {
                    console.log('[获取登录状态]返回：'+res.data)
                    if(res.data=="1"){
                        console.log("[获取登录状态]当前用户已经登录")
                        app.globalData.islogin=true
                        temp_this.startGoToIndex();
                        temp_flag=true;
                    }
                    else{
                        temp_this.startGoToLogin();
                    }
                },
                fail: function (res) {
                    console.log("[获取登录状态]没有返回登录状态")
                    wx.showModal({
                        title: '获取登录状态失败',
                        content: res.data,
                    })
                    wx.redirectTo({url: '/pages/login/login',})
                }
            })
        }
        catch (e) {
            this.startGoToLogin();
            console.log("[获取登录状态]无法获取上次会话")}
    },
    /*---------------------------------------获取公告内容---------------------------------------*/
    startGetNotice: function () {
        var temp_this = this
        wx.request({
            url: 'https://fix.fyscu.com/api/onpage/start/get_notice.php',
            data: {tocken: '00000000',},
            method: 'GET',
            header: {'content-type': 'application/json'},
            success: function (res) {
                console.log(res.data)
                temp_this.setData({startNoticeText: res.data})
            },
            fail: function (res) {
                console.log("[获取公告文本]无法获取公告内容")
                wx.showModal({
                    title: '获取公告失败',
                    content: res.data,
                })
            }
        })
    }
    /*---------------------------------------获取公告内容---------------------------------------*/
})