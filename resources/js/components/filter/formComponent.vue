<template>
  <section>
    <!-- filter header for web screen -->
    <div class="container w3-card w3-padding filter-header filter-header-web">
      <form class="" dir="rtl">
        <div class="row">
          <div class="form-group col-md-3">
            <label> نوع العقار </label>
            <select name="type_id" v-model="type_id" class="form-control">
              <option v-for="type in agarType" @click="filter()"  :value="type.type_id"> {{ type.type_name }} </option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label for="floor_id">الطابق</label>
            <select name="floor_id" v-model="floor_id" class="form-control">
                <option v-for="floor in agarFloor" @click="filter()" :value="floor.floor_id"> {{ floor.floor_name }} </option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label> تاريخ الحجز </label>
            <date-picker v-model="range" style="width: 220px" range @change="filter()" lang="en" type="date" formate="YYYY-MM-dd"></date-picker>
          </div>
          <div class="form-group col-md-3">
            <label> مكان السكن </label>
            <select name="location" v-model="location" class="form-control" >
              <option v-for="location in agar_location" @click="filter()" :value="location.geo_loc_id">{{ location.area }}</option>
            </select>
          </div>
        </div>
      </form>
    </div>

    <!-- filter header for mobile screen -->
    <section class="w3-card w3-padding filter-header filter-header-mobile" style="margin-bottom: 50px;">
      <div class="container">
        <form class="">
          <div class="form-group filter-header-mobile-datepicker">
            <p> تاريخ الحجز <date-picker v-model="range" range @change="filter()" lang="en" type="date" formate="YYYY-MM-dd" style="width: 100%"></date-picker> </p>
          </div>
          <div class="form-group open-slider-btn">
            <a href="javascript::void()" id="openNav" class="w3-button w3-xxlarge" onclick="open_filter()"> <i class="fa fa-sliders"></i> </a>
          </div>
        </form>
      </div>
    </section> 

    <br>

    <!-- sidebar for web screen -->
    <div class="w3-third filter_web_sidebar">
      <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            سعر الايجار لليوم الواحد
            <vue-slider  @change="filter()"
              v-model="price"
              :min="100"
              :max="10000"
              :interval="1" >
            </vue-slider>
          </li>
        </ul>
      </div>
      <br>
      <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            العملة
            <select name="currency" v-model="currency" class="form-control" >
              <option @click="filter()" value="1"> جنيه </option>
              <option @click="filter()" value="2"> دولار </option>
            </select>
          </li>
        </ul>
      </div>
      <br>
      <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <label> عدد الغرف </label>
            <input type="number" @change="filter()" class="form-control" v-model="rooms_number" name="rooms_number" />
          </li>
        </ul>
      </div>
      <br>
      <div class="card" style="width: 18rem;">
        <div class="card-header">
          المرافق
        </div>
        <ul class="list-group list-group-flush ">
          <li class="list-group-item">
            <h4> المرافق الاساسية  </h4>
            <div v-for="b in agar_b_extra">
              <span> {{ b.name }} </span>
              <input :value="b.name" @change="filter()" v-model="b_extra" type="checkbox" class="" />
            </div>
          </li>
          <li class="list-group-item">
            <h4> المرافق الاضافية  </h4>
            <div v-for="a in agar_a_extra">
              <span> {{ a.name }} </span>
              <input :value="a.name" @change="filter()" v-model="a_extra" type="checkbox" class="" />
            </div>
          </li>
          <li class="list-group-item">
            <h4> المرافق الخاصة  </h4>
            <div v-for="s in agar_s_extra">
              <span> {{ s.name }}  </span>
              <input :value="s.name" @change="filter()" v-model="sf_extra" type="checkbox" class="" />
            </div>
          </li>
          <li class="list-group-item">
            <h4>  شروط السكن  </h4>
            <div v-for="cond in agar_cond">
              <span> {{ cond.name }}  </span>
              <input :value="cond.name" @change="filter()" v-model="cond_extra" type="checkbox" class="" />
            </div>
          </li>
        </ul>
      </div>
      <br>
      <div class="card" style="width: 18rem;">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <button type="button" @change="filter()" name="search_btn" class="w3-button w3-black">بحث</button>
          </li>
        </ul>
      </div>
    </div>


    <!-- sidebar for mobile screen -->
    <div class="w3-sidebar w3-animate-left" id="filter_sidebar" style="display: none">
      <a href="javascript::void()" class="w3-button w3-large"
      onclick="close_filter()"> <i class="fa fa-times w3-large w3-hover-none w3-text-black"></i> </a>
      <div class="">
        <div class="card" >
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              سعر الايجار لليوم الواحد
              <vue-slider  @change="filter()"
                v-model="price"
                :min="100"
                :max="10000"
                :interval="1" >
              </vue-slider>
            </li>
          </ul>
        </div>
        <br>
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              العملة
              <select name="currency" v-model="currency" class="form-control" >
                <option @click="filter()" value="1"> جنيه </option>
                <option @click="filter()" value="2"> دولار </option>
              </select>
            </li>
          </ul>
        </div>
        <br>
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              مكان السكن
              <select name="location" v-model="location" class="form-control" >
                <option v-for="location in agar_location" @click="filter()" :value="location.geo_loc_id">{{ location.area }}</option>
              </select>
            </li>
          </ul>
        </div>
        <br>
        <div class="card">
          <div class="card-header">
            المرافق
          </div>
          <ul class="list-group list-group-flush ">
            <li class="list-group-item">
              <h4> المرافق الاساسية  </h4>
              <div v-for="b in agar_b_extra">
                <span> {{ b.name }} </span>
                <input :value="b.name" @change="filter()"   v-model="b_extra" type="checkbox" class="" />
              </div>
            </li>
            <li class="list-group-item">
              <h4> المرافق الاضافية  </h4>
              <div v-for="a in agar_a_extra">
                <span> {{ a.name }} </span>
                <input :value="a.name" @change="filter()"  v-model="a_extra" type="checkbox" class="" />
              </div>
            </li>
            <li class="list-group-item">
              <h4> المرافق الخاصة  </h4>
              <div v-for="s in agar_s_extra">
                <span> {{ s.name }}  </span>
                <input :value="s.name" @change="filter()" v-model="sf_extra" type="checkbox" class="" />
              </div>
            </li>
            <li class="list-group-item">
              <h4>  شروط السكن  </h4>
              <div v-for="cond in agar_cond">
                <span> {{ cond.name }}  </span>
                <input :value="cond.name" @change="filter()" v-model="cond_extra" type="checkbox" class="" />
              </div>
            </li>
          </ul>
        </div>
        <br>
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span>عدد الغرف</span>
              <input type="number" @change="filter()" class="form-control" v-model="rooms_number" name="rooms_number" >
              <span>عدد الحمامات</span>
              <input type="number" @change="filter()" v-model="bathrooms_number" name="bathrooms_number" class="form-control" >
            </li>
          </ul>
        </div>
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span>نوع العقار</span>
              <select name="type_id" v-model=type_id class="form-control">
                <option v-for="type in agarType" @click="filter()"  :value="type.type_id"> {{ type.type_name }} </option>
              </select>
              <span>الطابق</span>
              <select name="floor_id" v-model="floor_id" class="form-control">
                  <option v-for="floor in agarFloor" @click="filter()" :value="floor.floor_id"> {{ floor.floor_name }} </option>
              </select>
            </li>
          </ul>
        </div>
        <br>
        <div class="card">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <button type="submit" name="search_btn" class="w3-button w3-black">بحث</button>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="w3-modal" id="loading" style="display: none;background-color: transparent!important;">
      <div class="w3-panel w3-modal-content w3-animate-zoom" style="max-width:480px;background-color: transparent!important;">
        <img :src="this.loading_icon" width="100%" height="100%" alt="">
      </div>
    </div>

  </section>

</template>

<script>
  // to import datepicker component
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
  // to import slider component
  import VueSlider from 'vue-slider-component';
  import 'vue-slider-component/theme/antd.css';

	export default{
    components: { DatePicker ,VueSlider },
    props:{
      agarType: {
          type: Array,
          default: []
      },
      agarFloor: {
        type: Array,
        default: []
      },
      agar_b_extra: {
        type: Array,
        default: []
      },
      agar_a_extra: {
        type: Array,
        default: []
      },
      agar_s_extra: {
        type: Array,
        default: []
      },
      agar_cond: {
        type: Array,
        default: []
      },
      agar_location: {
        type: Array,
        default: []
      }
    },
		data(){
			return{
        date: '',
        range: [],
        price: 0,
        rooms_number: 0,
        bathrooms_number: 0,
        floor_id: 0,
        type_id: 0,
        location: '',
        currency: '',
        b_extra: [],
        a_extra: [],
        sf_extra: [],
        cond_extra: [],
        loading_icon: document.querySelector('meta[name="loading_icon"]').getAttribute('content')
			}
		},
		methods:{
      filter(){
        document.getElementById('loading').style.display = 'block';
  			axios.post('/agars/filter',{
          rooms_number: this.rooms_number,
          bathrooms_number: this.bathrooms_number,
          floor_id: this.floor_id,
          type_id: this.type_id,
          range: this.range,
          price: this.price,
          location: this.location,
          b_extra: this.b_extra,
          a_extra: this.a_extra,
          sf_extra: this.sf_extra,
          cond_extra: this.cond_extra,
          currency: this.currency,
          _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }).then((response) => {
            document.getElementById('loading').style.display = 'none';
            this.$emit('new', response.data);
        });
  		}
    }
	}
</script>
