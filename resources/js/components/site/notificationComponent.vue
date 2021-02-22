<template>
	<div>
		<a href="/messenger" class="w3-bar-item w3-hover-none w3-button">
			<i class="fa fa-envelope-o"></i>
			<span class="badge badge-light" id="notifi" style="position: relative; top: 5px; left: -5px;padding: 3px 5px;border-radius: 50%">
				 {{ this.message_count }}
			</span>
		</a>
		<a href="/notification" class="w3-bar-item w3-hover-none w3-button">
			<i class="fa fa-bell-o" style="margin-top: 8px"></i>
			<span class="badge badge-light" id="bell_notifi" style="position: relative; top: 5px; left: -5px;padding: 3px 5px;border-radius: 50%">
				 {{ this.notification_count  }}
			</span>
		</a>
	</div>
</template>

<script>
	export default{
		props: {
				user: {
						type: Number,
						required: true
				}
		},
		data(){
			return{
				message_count : 0,
				notification_count: 0,
			}
		},
		mounted(){
			axios.get('/messenger/count').then((response) => {
				this.message_count = response.data;
			});
			axios.get('/notification/count').then((response) => {
				this.notification_count = response.data;
			}).then((response) => {
				
				Echo.private(`notification.${this.user}`)
						.listen('NewNotification', (e) => {
								var counter = parseInt(document.getElementById('bell_notifi').innerText);
								document.getElementById('bell_notifi').innerHTML = counter + 1;
						});
			});

		}
	}
</script>
