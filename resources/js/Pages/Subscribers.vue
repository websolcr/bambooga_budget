<script>
import SubscribersTable from '@/Components/Subscribers/SubscribersTable.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    name: 'Subscribers',

    components: {
        SubscribersTable,
        AppLayout
    },

    data() {
        return {
            subscribers: [
            {name: 'Kushan', membership_number: 1},
            {name: 'Suresh', membership_number: 2},
            ],
        }
    },
}
</script>

<template>
    <AppLayout title="සාමාජිකයන්">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                සාමාජිකයන්
            </h2>
        </template>
        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8 space-y-2">
                <SubscribersTable 
                    :subscribers="subscribers" 
                />
            </div>
        </div>
    </AppLayout>
</template>