<template>
  <div>
    <div class="w3-section">
      <label for="start_date">تاريخ الوصول</label>
      <date-picker v-model="start_date" @change="calculate_price()" lang="en" type="date" formate="YYYY-MM-dd" style="width: 100%"></date-picker>
    </div>
    <div class="w3-section">
      <label for="end_date">تاريخ المغادرة</label>
      <date-picker v-model="end_date" @change="calculate_price()" lang="en" type="date" formate="YYYY-MM-dd" style="width: 100%"></date-picker>
    </div>

    <p class="w3-section w3-center w3-xlarge w3-text-red" style="border-radius:50%" id="reservation_price"></p>

    <p id="reservation_date_error" class="w3-brnda w3-padding" style="display: none;"></p>

    <!--
    <div class="w3-modal" id="loading" style="display: none;background-color: transparent!important;">
      <div class="w3-panel w3-modal-content w3-animate-zoom" style="max-width:480px;background-color: transparent!important;">
        <img :src="this.loading_icon" width="100%" height="100%" alt="">
      </div>
    </div>
  -->

    <div class="w3-section">
        <button form="booking_form" type="button" @click="sent()" id="request_booking" name="request_booking" value="" class="w3-btn w3-block w3-brnda">
            <i class="fa fa-calendar"></i> طلب الحجز</button>
    </div>
  </div>
</template>

<script>
  // to import datepicker component
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
  import 'vue2-datepicker/locale/zh-cn';

	export default{
    components: { DatePicker },
    props:{
      agar_id: {
        require: true,
        type: Number
      },
      owner_id: {
        require: true,
        type: Number
      }
    },
    data(){
			return{
        //loading_icon: document.querySelector('meta[name="loading_icon"]').getAttribute('content'),
        start_date: '',
        end_date: '',
			}
		},
    methods: {
      calculate_price(){
        //document.getElementById('loading').style.display = 'block';
        axios.post('/reservation/calculate_price',{
          start_date: this.start_date,
          end_date: this.end_date,
          agar_id: this.agar_id,
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }).then((response) => {
          if(response.data != ''){
            //document.getElementById('loading').style.display = 'none';
            document.getElementById('reservation_price').innerHTML = 'تكلفة الحجز = ' + response.data;
          }
        });
      },
      sent(){
        axios.post('/reservation/add',{
          reciver_id: this.owner_id,
          start_date: this.start_date,
          end_date: this.end_date,
          agar_id: this.agar_id,
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }).then((response) => {
          if(response.data.code == 200){
            document.getElementById('reservation_date_error').style.display = 'none';
              document.getElementById('reservation_success').style.display = 'block';
          }
           // 407 is custom error code
          if(response.data.code == 407){
            document.getElementById('reservation_date_error').style.display = 'block';
            document.getElementById('reservation_date_error').innerHTML = response.data.message;
          }
          if(response.data.code == 400){
            document.getElementById('reservation_error').style.display = 'block';
          }

        });
      }
    }
	}
</script>
