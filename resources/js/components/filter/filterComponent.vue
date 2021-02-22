<template>
    <div class="w3-row-padding">
      <br>
      <formfilter
          :agarType="agarType"
          :agarFloor="agarFloor"
          :agar_b_extra="agar_b_extra"
          :agar_a_extra="agar_a_extra"
          :agar_s_extra="agar_s_extra"
          :agar_cond="agar_cond"
          :agar_location="agar_location"
          @new="pushResult"
          />
      <agars :agars="agars"/>
    </div>
</template>

<script>
    import formfilter from './formComponent';
    import agars from './agarsComponent';

    export default {
        props:{
          agarType: {
            type: Array
          },
          agarFloor: {
            type: Array
          },
          agar_b_extra: {
            type: Array,
          },
          agar_a_extra: {
            type: Array,
          },
          agar_s_extra: {
            type: Array,
          },
          agar_cond: {
            type: Array,
          },
          agar_location: {
            type: Array,
          },
          query: {
            type: String,
            default: ''
          },
          type_id: {
            type: String,
            default: ''
          }
        },
        data() {
            return {
                agars: {
                    type: [],
                    required: true
                }
            }
        },
        mounted() {
            axios.post('/agars/json',{
              query: this.query,
              type_id: this.type_id,
              _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            })
            .then((response) => {
                this.agars = response.data;
            });

        },
        methods: {
            pushResult(result) {
              console.log(result)
              this.agars = result;
            }
        },
        components: {agars , formfilter}
    }
</script>
