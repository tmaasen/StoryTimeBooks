<template>
    <div class="main-container">
        <h1 class="store-name">StoryTime Books</h1>
        <form>
            <div class="box-container">
                <h2 class="heading">
                Create Your Account
                </h2>
                <div class="form-fields">
                <input id="user_name" name="username" type="text" placeholder="Full name" required>
                </div>
                <div class="form-fields">
                <input id="email" name="email" type="text" placeholder="Email Address required">
                </div>
                <div class="form-fields">
                <input id="password" name="password" type="password" placeholder="Password" required>
                </div>
                <div class="form-fields">
                <button class="createaccount" name="commit" type="submit">
                    Create your account
                </button>
                </div>
                <div class="login-choice"><span>or sign up with</span></div>
                <SocialSignUp />
                <div>
                    <p class="center">
                        By signing up you agree to the
                        <a href="/termsofservice">Terms of Service</a>.
                    </p>
                    <p></p>
                </div>
            </div>
        </form>
        <div class="footer">
            <p>Already have an account? <a href="/login"> Sign In</a></p>
        </div>
    </div>
</template>

<script>
import SocialSignUp from '@/components/SocialLogin'
export default {
  name: 'signup',
  components: {
    SocialSignUp
  }
}
</script>