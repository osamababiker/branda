<template>
  <div>
    <div class="brnda-logo">
        <img src="images/branda_logo.PNG" class="" style="width: 90px; height: 100%;margin-top: 10px; margin-bottom: 7px;">
    </div>
    <h3 style="">انشاء حساب جديد</h3>
    <div class="form-group">
      <validation-provider name="name" rules="required|max:25" v-slot="{ errors }">
        <input class="w3-input w3-hover-border-gray @error('name') is-invalid @enderror" v-model="name" type="text" placeholder=" الاسم  " style="text-align: right;" name="name"  required autocomplete="name" autofocus/>
        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
          {{ errors[0] }}
        </span>
      </validation-provider>
    </div>
    <div class="form-group">
      <validation-provider name="username" rules="required|max:25" v-slot="{ errors }">
        <input class="w3-input w3-hover-border-gray @error('username') is-invalid @enderror" v-model="username" type="text" placeholder=" اسم المستخدم " style="text-align: right;" name="username"  required autocomplete="username" autofocus/>
        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
          {{ errors[0] }}
        </span>
      </validation-provider>
    </div>
    <div class="form-group">
      <validation-provider name="email" rules="required|max:25|email" v-slot="{ errors }">
        <input class="w3-input w3-hover-border-gray  @error('email') is-invalid @enderror" v-model="email" type="email" placeholder="البريد الإلكتروني" name="email" style="text-align: right;"  required autocomplete="email"/>
        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
          {{ errors[0] }}
        </span>
      </validation-provider>
    </div>
    <div class="form-group">
      <validation-provider name="phone" rules="required|max:12|min:9" v-slot="{ errors }">
        <input class="w3-input w3-hover-border-gray @error('phone') is-invalid @enderror" v-model="phone" type="tel" placeholder="رقم الهاتف" style="text-align: right;"  name="phone"  required autocomplete="phone" autofocus/>
        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
          {{ errors[0] }}
        </span>
      </validation-provider>
    </div>
    <div class="form-group">
      <validation-provider name="password" rules="required|min:6" v-slot="{ errors }">
        <input class="w3-input w3-hover-border-gray @error('password') is-invalid @enderror" v-model="password" name="password" required autocomplete="new-password" type="password" placeholder="كلمة المرور" style="text-align: right;"/>
        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
          {{ errors[0] }}
        </span>
      </validation-provider>
    </div>
    <div class="form-group">
      <validation-provider name="password_confirmation" rules="required|min:6" v-model="password_confirmation" v-slot="{ errors }">
        <input class="w3-input w3-hover-border-gray @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation" type="password" placeholder="اعادة كتابة كلمة المرور" style="text-align: right;"/>
        <span v-show="errors[0]" :class="{'form-control': true, 'alert-danger text-right': errors[0] }">
          {{ errors[0] }}
        </span>
      </validation-provider>
    </div>
    <div class="form-group">
      <button type="submit">انشاء حساب</button>
    </div>
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
