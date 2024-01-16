<template>
	<view class="feedback-section">
		<view class='feedback-row-section'>
			<view class='row-head-section'>意见标题(必填)</view>
			<view class='row-body-section'>
				<u--textarea v-model="formdata.title" placeholder="请输入意见标题" autoHeight ></u--textarea>
			</view>
		</view>
		
		<view class='feedback-row-section'>
			<view class='row-head-section'>意见内容(必填)</view>
			<view class='row-body-section'>
				<u--textarea v-model="formdata.contents" placeholder="请输入意见内容" autoHeight ></u--textarea>
			</view>
		</view>
		
		<view class='feedback-row-section'>
			<view class='row-head-section'>图片（选填，提供问题截图）</view>
			<view class='row-body-section'>
				<view>
					<img v-for="(src,index) of imgs" :src="src" :key="index"/>
				</view>
				<button type='button' class='btn login-btn' @click="handleChooseImages">选择图片</button>
			</view>
		</view>
		
		<view class='feedback-row-section'>
			<view class='row-head-section'>联系方式(选填)</view>
			<view class='row-body-section'>
				<input type="phone" v-model="formdata.phone" placeholder="手机号码，用于与您联系" class="form-phone" />
			</view>
		</view>
		
		<view class='footer-row-section'>
			<button type='button' class='btn login-btn' @click="submit">提交</button>
		</view>
	</view>
</template>

<script>
	export default {
		data(){
			return {
				channel:0,
				socket_state:0,
				nums:0,
				imgs:[],
				formdata:{
					title:"",
					contents:"",
					phone:"",
					images:[],
				}
			}
		},
		methods: {
			submit(){
				if(this.formdata.title.trim().length==0){
					uni.showToast({
						title: '请输入反馈标题',
						icon:'none'
					});
					return false;
				}else if(this.formdata.contents.trim().length==0){
					uni.showToast({
						title: '请输入反馈内容',
						icon:'none'
					});
					return false;
				}
				this.$send('send_feedback',this.formdata,this.channel);
			},
			handleChooseImages(){
				if(this.nums<3){
					uni.chooseImage({
						success: (chooseImageRes) => {
							const tmpFilePaths = chooseImageRes.tempFilePaths;
							let diff = 3-this.nums;
							for(let file of tmpFilePaths){
								if(diff>0){
									diff -= 1;
									uni.uploadFile({
										url: 'http://lao.ibiancheng.net/upload.php',
										filePath:file,
										name: 'file',
										formData: {
											'token': 'qsc@#@zse'
										},
										success: (res) => {
											const {code,data:{src2:src=''}} = JSON.parse(res.data);
											if(code == 200){
												this.imgs.push(src);
												this.nums++;
											}
										}
									});
								}
							}
							/*uni.uploadFile({
								url: 'https://www.example.com/upload', //仅为示例，非真实的接口地址
								filePath: tempFilePaths[0],
								name: 'file',
								formData: {
									'user': 'test'
								},
								success: (uploadFileRes) => {
									console.log(uploadFileRes.data);
								}
							});*/
						}
					});
				}else{
					uni.showToast({
						title: '至多可上传三张附件',
						icon:'none'
					});
				}
			},
			handlekeydown(e){
				console.log(e,e.keyCode);
			},
			logout(){
				uni.showModal({
					title: '温馨提示',
					content: '您确定要退出登录吗?',
					success:(res)=>{
						if (res.confirm) {
							uni.clearStorage();
							this.$store.commit('settoken','');

							this.$gopage('/login/index');
						} else if (res.cancel) {
							console.log('用户点击取消');
						}
					}
				});
			},
			add(){
				this.$store.commit('add');
			},
		},mounted(){
			
		}
	}
</script>

<style lang="scss">
.feedback-section{
	.feedback-row-section{
		margin:15px 0;
		.row-head-section{
			padding:0 23rpx;
			line-height:50rpx;
		}
		.row-body-section{
			background-color:#fff;
		}
		
		&:first-child{margin-top:10px;}
	}
	
	.form-phone{padding:0 23rpx;height:80rpx;line-height:50rpx;display:flex;align-items:center;}
	
	.footer-row-section{margin:0 auto;padding:45rpx 0;}
	.footer-row-section>.btn{
		margin:0 auto;
		width:70%;height:80rpx;line-height:75rpx;
		border-radius:40rpx;
		color:#fff;
		outline:none;
		background-color: rgb(0, 141, 212);border: 1px solid rgb(0, 141, 212);
	}
}
.home-section{
	width:100%;
	height:calc( 100% - 80px );
	position:relative;
	overflow:hidden;
	
	.home-header-section{
		margin:0 25rpx;
		padding-top:30rpx;	
	}
	
	.home-grid-section{
		margin:25rpx auto;
		width:100%;
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
	
		.grid-item{
			padding:20rpx 0 1rpx 0;
			width:33.33%;

			.item-icon{
				margin:0 auto;
				width:100rpx;border-radius:50%;
				height:100rpx;line-height:120rpx;
				background-color:#fff;
				display: flex;
				align-items: center;
				justify-content: center;
				i.fa{margin-top:7rpx;margin-left:10rpx;font-size:30px;color:#222;}
			}

			.item-text{
				width:100%;height:50rpx;
				display: flex;
				align-items: center;
				justify-content: center;
				text-align: center;font-size:14px;
			}
		}
	}
	
	.page-footer-section{
		padding-bottom:38rpx;
		width:100%;
		text-align:center;
		color:#999;
		position:fixed;left:0;bottom:0;
		
		
		.version{
			width:100%;height:40rpx;display:flex;font-size:14px;
			align-items: center;justify-content: center;
			color:#999;
		}

		.copyright{
			width:100%;height:40rpx;display:flex;
			align-items: center;justify-content: center;
			color:#999;
		}
	}
}
</style>
