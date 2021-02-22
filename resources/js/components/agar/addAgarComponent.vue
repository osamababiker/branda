<template>
  <div>
      <div class="w3-row-padding">
          <div class="w3-margin-bottom w3-third">
              <label for="agar_name">الاسم </label>
              <input id="agar_name"  name="agar_name" class="w3-input" type="text" placeholder="الاسم"
                     required>
          </div>
          <div class="w3-margin-bottom w3-third">
              <label for="type_id">نوع العقار</label>
              <select @change="getFloor()" id="type_id" class="w3-input" name="type_id">
                <option value="" selected disabled>اختر نوع العقار</option>
                <option v-for="type in types"  required="required"
                          :value="type.type_id">{{ type.type_name }}</option>
              </select>
          </div>
          <div id="floor_container" class="w3-margin-bottom w3-third">
              <label for="floor_id">الطابق</label>
              <select id="floor_id" class="w3-input" name="floor_id">
                  <option v-for="floor in agarFloor" id="floor_id"
                          :value="floor.floor_id">{{ floor.floor_name }}</option>
              </select>
          </div>
      </div>
      <div class="w3-margin-bottom">الموقع الجغرافي</div>
      <div class="w3-row-padding">
          <div class="w3-margin-bottom w3-third">
              <label for="state_id">الولاية</label>
              <select id="state_id"  @change="getCity()" class="w3-input" name="state_id">
                  <option value="" selected disabled>  اختر الولاية </option>
                  <option v-for="state in states" id="state_id"
                       :value="state.state_id">{{ state.state_name }}</option>
              </select>
          </div>
          <div class="w3-margin-bottom w3-third">
              <label for="city_id">المدينة</label>
              <select id="city_id" class="w3-input" name="city_id">
                @foreach($citys as $city)
                  <option v-for="city in citys" id="city_id"
                          :value="city.city_id">{{ city.city_name }}</option>
                @endforeach
              </select>
          </div>
          <div class="w3-margin-bottom w3-third">
              <label for="area">الحي</label>
              <input id="area"  name="area" class="w3-input" type="text"
                     placeholder="الحي" required value=""
                     value="">
          </div>
      </div>
      <div class="w3-row-padding">
          <div class="w3-margin-bottom w3-half">
              <label for="rooms_number">عدد الغرف</label>
              <input id="rooms_number"  name="rooms_number" class="w3-input" type="number"
                     placeholder="عدد الغرف" required  value=""
                     value="">
          </div>
          <div class="w3-margin-bottom w3-half">
              <label for="bathrooms_number">عدد الحمامات</label>
              <input id="bathrooms_number"  name="bathrooms_number" class="w3-input" type="number"
                     placeholder="عدد الحمامات" required>
          </div>
      </div>

      <div class="w3-margin-bottom">
          <label for="agar_desc">الوصف</label>
          <textarea id="agar_desc" name="agar_desc" class="w3-input" required></textarea>
      </div>
  </div>
</template>

<script>

	export default{
    props:{
      types:{
        require: true,
      },
      states:{
        require: true,
      },
    },
    data(){
			return{
        citys: [],
        agarFloor: []
			}
		},
    methods: {
      getCity(){
        axios.post('/agars/add/get_city_as_json',{
          state_id: event.target.value,
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }).then((response) => {
          this.citys = response.data;
        });
      },
      getFloor(){
        axios.post('/agars/add/get_floor_as_json',{
          type_id: event.target.value,
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }).then((response) => {
          this.agarFloor = response.data;
        });
      }
    }
	}
</script>
