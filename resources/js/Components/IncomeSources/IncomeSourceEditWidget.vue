<template>
    <div
      :class="isShowing ? 'show' : ''"
      class="slide-in overflow-y-scroll p-2 space-y-2 flex flex-col"
    >
      <div >
        <div
          class="py-4 px-2 space-x-2"
        >
          <div
            class="text-sm"
          >
            <!-- {{ incomeSource.id ? 'වෙනස් කරන්න' : 'එකතු කරන්න' }} -->
          </div>
          <CloseIcon
            class="w-6 h-6 float-right cursor-pointer text-green-default"
            @click="$emit('close')"
          />
          <!-- <div class="font-semibold text-xs italic">
            නව ආදායම් මාර්ගයක් ඇතුළත් ක‍රන්න.
          </div> -->
        </div>
  
        <div
          class="space-y-2 divide-y divide-green-default"
          style="min-height: calc(100vh - 250px)"
        >
          <div class="flex flex-col space-y-2">
            <div class="divide-y divide-green-default space-y-2 p-2">
              <div class="space-y-2 text-sm">
                                
                <div>
                  <label for="name">නම</label>
                  <base-input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="w-full"
                  />
                </div>
                <div>
                  <label for="amount">ගාස්තුව</label>
                  <base-input
                    id="amount"
                    v-model="form.amount"
                    type="number"
                    class="w-full"
                  />
                </div>
                <div>
                  <label for="valid_date">වලංගු වන්නේ කවදා සිට ද?</label>
                  <base-input
                    id="valid_date"
                    v-model="form.valid_date"
                    type="date"
                    class="w-full"
                  />
                </div>
                
              </div>
            </div>
          </div>
        </div>
  
        <div class="pt-4 space-y-2">
          <app-button
            class="w-full h-10 font-semibold"
            label="save"
            @click="$emit('save', {
              ...form,
            })"
          />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import CloseIcon from '@/Icons/CloseIcon.vue'
  import AppButton from "@/Components/AppButton.vue"
  import BaseInput from '@/Components/Common/BaseInput.vue'
  
  
  export default {
      name: 'IncomeSourceEditWidget',
  
      components: {
          BaseInput,
          AppButton,
          CloseIcon
      },
  
      props: {
          isShowing: {
              type: Boolean,
              default: () => false,
          },
  
          incomeSource: {
              type: Object,
              default: () => null,
          },
  
      },
  
      data() {
          return {
              form: {},
          }
      },
  
      computed: {

      },
  
      watch: {
          incomeSource: {
              deep: true,
              immediate: true,
              handler() {
                  this.form = {...this.incomeSource}
              }
          },
      },
  }
  </script>
  
  <style scoped>
  .slide-in {
      width: 350px;
      position: fixed;
      top: 64px;
      /*top: calc(64px - 10px);*/
      right: -100%;
      background: white;
      height: calc(100% - 64px);
      box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.5);
      transition: all 0.8s ease-in-out;
  }
  
  .show {
      right: 0;
  }
  </style>
  