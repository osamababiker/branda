<template>
    <div>
      <div class="brnda-logo">
        <img src="images/branda_logo.PNG" class="" style="width: 90px; height: 100%;margin-bottom: 20px;">
      </div>
      <h1>تسجيل الدخول</h1>

      <validation-provider name="email" rules="required|max:25|email" v-slot="{ errors }">
        <input class="w3-input w3-hover-border-gray @error('email') is-invalid @enderror" v-model="email" name="email" type="email" placeholder="البريد الإلكتروني" style="text-align: right;"  required autocomplete="email" autofocus />
        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
          {{ errors[0] }}
        </span>
     </validation-provider >
     <validation-provider name="password" rules="required|max:25|min:6" v-slot="{ errors }">
        <input class="w3-input w3-hover-border-gray @error('password') is-invalid @enderror" v-model="password" type="password" placeholder="كلمة المرور" style="text-align: right;" name="password" required autocomplete="current-password" />
        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
          {{ errors[0] }}
        </span>
      </validation-provider>
      <a href="#">هل نسيت كلمة المرور ؟</a>
      <button>تسجيل الدخول</button>
  </div>
</template>

<script>
    import { ValidationProvider } from 'vee-validate';
    export default {
        components: {
            ValidationProvider
        },
        mounted() {

        }
    }
</script>
