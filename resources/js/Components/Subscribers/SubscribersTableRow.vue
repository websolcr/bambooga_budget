<template>
    <div :class="{'bg-green-50': isExpanded}">
      <div
        class="flex divide-x divide-green-default"
      >
        <div
          v-if="columnVisibility.index.visible"
          class="p-3 text-sm flex items-center justify-center text-center"
          :style="{width: columnVisibility.index.width}"
        >
          {{ index }}
        </div>
        <div
          v-if="columnVisibility.name.visible"
          class="p-3 text-sm flex items-center justify-center text-center"
          :style="{width: columnVisibility.name.width}"
        >
          {{ subscriber.name }}
        </div>
        <div
          v-if="columnVisibility.membershipNumber.visible"
          class="p-3 text-sm flex items-center justify-center text-center space-x-2"
          :style="{width: columnVisibility.membershipNumber.width}"
        >
          <div>{{ subscriber.membership_number }}</div>
        </div>     
      </div>      
    </div>
  </template>
  
  <script>
  
//   import {isNull} from "lodash"
    
  export default {
      name: 'SubscribersTableRow',
  
     
  
      props: {
          subscriber: {
              type: Object,
              required: true,
          },
  
          index: {
              type: Number,
              required: true,
          },
          columnVisibility: {
            type: Object,
            required: true,
        },
    },
  
      data() {
          return {
              isExpanded: false,
              familyDetails: [],
              shouldLoad: false,
          }
      },
}
  </script>
  