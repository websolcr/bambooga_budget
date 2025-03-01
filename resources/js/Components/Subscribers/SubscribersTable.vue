<template>
    <div class="bg-white shadow-lg rounded-lg text-sm">
      <div class="flex divide-x divide-green-default">
        <div
          :class="styleClasses"
          :style="{width: columnVisibility.index.width}"
        >
          #
        </div>
        <div
          v-if="columnVisibility.name.visible"
          :class="styleClasses"
          :style="{width: columnVisibility.name.width}"
        >
          නම
        </div>
        <div
          v-if="columnVisibility.membershipNumber.visible"
          :class="styleClasses"
          :style="{width: columnVisibility.membershipNumber.width}"
        >
          සාමාජික අංකය
       
        </div>
        <div
          v-if="columnVisibility.OutstandingAmount.visible"
          :class="styleClasses"
          :style="{width: columnVisibility.OutstandingAmount.width}"
        >
            හිග මුදල
       
        </div>
        <div
          v-if="columnVisibility.MembershipFee.visible"
          :class="styleClasses"
          :style="{width: columnVisibility.MembershipFee.width}"
        >
          සාමාජික මුදල
       
        </div>
        <div
          v-if="columnVisibility.MembershipFee.visible"
          :class="styleClasses"
          :style="{width: columnVisibility.MembershipFee.width}"
        >
            දඩ මුදල
       
        </div>
      </div>
      <div
        class="divide-y divide-gray-200 bg-white rounded-b-lg"
      >
        
        <div
          v-if="!subscribers.length"
          class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6"
        >
          No records.
        </div>
  
        <div
          v-else
          class="divide-y divide-green-default"
        >
          <SubscribersTableRow
            v-for="(subscriber, index) in subscribers"
            :key="subscriber.id"
            :subscriber="subscriber"
            :index="index + 1"
            :column-visibility="columnVisibility"
          />
        </div>
      </div>
    </div>
  </template>
  
  <script>
  
  import SubscribersTableRow from "./SubscribersTableRow.vue"
  import Spinner from "vue-spinner/src/ClipLoader.vue"
  
  export default {
      name: 'SubscribersTable',
  
      components: {Spinner, SubscribersTableRow},
  
      props: {
          subscribers: {
              type: Array,
              required: true,
          },
      },
  
      computed: {
          styleClasses() {
              return 'text-green-default border-b border-green-default font-semibold p-3 text-sm flex items-center justify-center text-center'
          },
  
          columnVisibility() {
              return {
                  index: {visible: true, width: '3%'},
                  name: {visible: true, width: '20%'},
                  membershipNumber: {visible: true, width: '20%'},
                  OutstandingAmount: {visible: true, width: '20%'},
                  MembershipFee: {visible: true, width: '20%'},
                  FineAmount : {visible: true, width: '20%'},
                }
          },
  
      },
  
      methods: {

      }
  
  }
  </script>
  