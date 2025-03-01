<template>
    <footer
      class="bg-gray-100"
    >
      <div class="mx-auto w-full py-2 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
        <div class="flex justify-center space-x-6 md:order-2">
          <a
            class="text-gray-400 hover:text-gray-500 cursor-pointer"
            @click="dial(+94701810070)"
          >
            <PhoneIcon
              class="h-6 w-6"
              aria-hidden="true"
            />
          </a>
          <a
            class="text-gray-400 hover:text-gray-500 cursor-pointer"
            @click="sendMail('websolcr@gmail.com')"
          >
            <EmailIcon
              class="h-6 w-6"
              aria-hidden="true"
            />
          </a>
          <a
            class="text-gray-400 hover:text-gray-500 cursor-pointer"
            href="https://github.com/websolcr"
            target="_blank"
          >
            <GitHubIcon
              class="h-6 w-6"
              aria-hidden="true"
            />
          </a>
          <a
            class="text-gray-400 hover:text-gray-500 cursor-pointer"
            href="https://websolcr.com/"
            target="_blank"
          >
            <GlobeIcon
              class="h-6 w-6"
              aria-hidden="true"
            />
          </a>
        </div>
        <div class="mt-8 md:order-1 md:mt-0">
          <p class="text-center text-base text-gray-400">
            &copy; Design and developed by websolcr.
          </p>
        </div>
      </div>
    </footer>
  </template>
  
  <script>
import EmailIcon from '@/Icons/EmailIcon.vue';
import GitHubIcon from '@/Icons/GitHubIcon.vue';
import GlobeIcon from '@/Icons/GlobeIcon.vue';
import PhoneIcon from '@/Icons/PhoneIcon.vue';

  
  
  export default {
      name : 'AppFooter',
  
      components : {
          PhoneIcon,
          EmailIcon,
          GlobeIcon,
          GitHubIcon
      },
  
      methods : {
          sendMail(mail){
              window.location = 'mailto:'+mail
          },
  
          dial(number){
              window.location = 'tel:'+number
          },
      },
  }
  </script>
  