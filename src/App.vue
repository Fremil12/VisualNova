<script setup>
import LandingPage from './components/LandingPage.vue';
import ProfileSettings from './components/ProfileSettings.vue'
import AboutUser from './components/AboutUser.vue';

</script>

<template>
  <header>
    <nav>
      <img src="" alt="Logo">
      <ul>
        <li>
          Main Page
        </li>
        <li>
          About us
        </li>
        <li>
          Campaign writer
        </li>
      </ul>
      <p>
        <button>Sign up</button>
        <button>Sign in</button>
      </p>
      <img src="" alt="ProfPic">
    </nav>
  </header>
  <main>
    <LandingPage />
    <ProfileSettings/>
    <AboutUser/>
  </main>
  <footer>
    <p>
      <strong>Lorem</strong>
      <strong>Lorem</strong>
      <strong>Lorem</strong>
      <img src="" alt="Logo">
      <strong>Lorem</strong>
      <strong>Lorem</strong>
      <strong>Lorem</strong>
    </p>
    <div>
      <img src="" alt="pic1">
      <img src="" alt="pic2">
      <img src="" alt="pic3">
      <img src="" alt="pic4">
      <img src="" alt="pic5">
    </div>
    All rights reserved!
  </footer>
</template>

<style scoped></style>
