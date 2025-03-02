<script>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import JetBanner from '@/Components/Banner.vue';
import JetDropdown from '@/Components/Dropdown.vue';
import JetDropdownLink from '@/Components/DropdownLink.vue';
import JetNavLink from '@/Components/NavLink.vue';
import JetResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import AppFooter from './AppFooter.vue';
import AppButton from "@/Components/AppButton.vue"

export default {
    name: 'AppLayout',

    components: {
        AppFooter,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Head,
        Link,
        ref,
        AppButton,
    },

    props: {
        title: {
            type: String,
            default: () => null
        }
    },

    data() {
        return {
            showingNavigationDropdown: ref(false),
            navigations: [
                {name: 'සාමාජිකයන්', href: '/'},
                {name: 'ආදායම් මාර්ග', href: '/Income_sources'},
            ]
        }
    },

    computed: {
        currentUri() {
            return window.location.pathname
        },

        showPreProductionWarning() {
            return (
                document
                    .querySelector("meta[name='app-env']")
                    .getAttribute('content') !== 'production'
            )
        },

        user() {
            const authUser = this.$page.props.user

            return authUser ?? {
                name: 'Guest'
            }
        },

        isGuestUser() {
            return this.user.name === 'Guest'
        },

        navigationsWithAccessPermission() {
            return this.navigations
        },

        appVersion() {
            return document
                .querySelector("meta[name='app-version']")
                .getAttribute('content')
        },
    },

    methods: {
        switchToTeam(team) {
            Inertia.put(route('current-team.update'), {
                team_id: team.id,
            }, {
                preserveState: false,
            })
        },

        logout() {
            Inertia.post(route('logout'))
        },

        login() {
            Inertia.get(route('login'))
        },
    },
}
</script>

<template>
    <div>
        <Head :title="title" />

        <JetBanner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <img
                                    src="/images/bsoftLogo.png"
                                    alt="logo"
                                    class="h-9 w-11"
                                >
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <JetNavLink 
                                    v-for="item in navigations"
                                    :key="item.name"
                                    :href="item.href"
                                >
                                    {{ item.name }}
                                </JetNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <div class="ms-3 relative">
                                <!-- Teams Dropdown -->
                                <JetDropdown 
                                    v-if="$page.props.jetstream.hasTeamFeatures" 
                                    align="right" 
                                    width="60"
                                >
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button 
                                                type="button" 
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                            >
                                                {{ user.current_team.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                <template #content>
                                    <div class="w-60">
                                            <!-- Team Management -->
                                        <template v-if="$page.props.jetstream.hasTeamFeatures">
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Team
                                            </div>

                                            <!-- Team Settings -->
                                            <JetDropdownLink 
                                               :href="route('teams.show', $page.props.auth.user.current_team)"
                                            >
                                                    Team Settings
                                            </JetDropdownLink>

                                            <JetDropdownLink 
                                                v-if="$page.props.jetstream.canCreateTeams" 
                                                :href="route('teams.create')"
                                                >
                                                Create New Team
                                            </JetDropdownLink>

                                            <div class="border-t border-gray-100" />

                                            <!-- Team Switcher -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Switch Teams
                                            </div>

                                            <template 
                                                v-for="team in user.all_teams" 
                                                :key="team.id"
                                            >
                                                <form @submit.prevent="switchToTeam(team)">
                                                    <JetDropdownLink as="button">
                                                        <div class="flex items-center">
                                                            <svg 
                                                                v-if="team.id == user.current_team_id" 
                                                                class="me-2 h-5 w-5 text-green-400" 
                                                                xmlns="http://www.w3.org/2000/svg" 
                                                                fill="none" 
                                                                viewBox="0 0 24 24" 
                                                                stroke-width="1.5" 
                                                                stroke="currentColor"
                                                            >
                                                                <path 
                                                                    stroke-linecap="round" 
                                                                    stroke-linejoin="round" 
                                                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" 
                                                                />
                                                            </svg>

                                                            <div>{{ team.name }}</div>
                                                        </div>
                                                    </JetDropdownLink>
                                                </form>
                                            </template>
                                        </template>
                                    </div>
                                </template>
                                </JetDropdown>
                            </div>

                            <AppButton
                            v-if="isGuestUser"
                            label="Login"
                            @click="login"
                            />

                            <!-- Settings Dropdown -->
                            <div 
                                v-else
                                class="ms-3 relative flex items-center"
                            >
                                <div class="text-gray-500 text-xs">
                                    {{ appVersion }}
                                </div>
                                
                            <JetDropdown 
                                align="right" 
                                width="48"
                            >
                                <template #trigger>
                                    <button 
                                        v-if="$page.props.jetstream.managesProfilePhotos" 
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                        >
                                        <img 
                                            class="h-8 w-8 rounded-full object-cover" 
                                            :src="user.profile_photo_url" 
                                            :alt="user.name"
                                        >
                                    </button>

                                    <span 
                                        v-else 
                                        class="inline-flex rounded-md"
                                    >
                                        <button 
                                            type="button" 
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                        >
                                            {{ user.name }}

                                            <svg 
                                                class="ms-2 -me-0.5 h-4 w-4" 
                                                xmlns="http://www.w3.org/2000/svg" 
                                                fill="none" 
                                                viewBox="0 0 24 24" 
                                                stroke-width="1.5" 
                                                stroke="currentColor"
                                            >
                                                <path 
                                                    stroke-linecap="round" 
                                                    stroke-linejoin="round" 
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" 
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Manage Account
                                    </div>

                                    <JetDropdownLink :href="route('profile.show')">
                                        Profile
                                    </JetDropdownLink>

                                    <JetDropdownLink 
                                        v-if="$page.props.jetstream.hasApiFeatures" 
                                        :href="route('api-tokens.index')"
                                    >
                                        API Tokens
                                    </JetDropdownLink>

                                    <div class="border-t border-gray-200" />

                                    <!-- Authentication -->
                                    <form @submit.prevent="logout">
                                        <JetDropdownLink as="button">
                                            Log Out
                                        </JetDropdownLink>
                                    </form>
                                </template>
                            </JetDropdown>
                        </div>
                    </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button 
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" 
                                @click="showingNavigationDropdown = ! showingNavigationDropdown"
                                >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <JetResponsiveNavLink
                            v-for="item in navigations"
                            :key="item.name"
                            :href="item.href"
                        >
                            {{ item.name }}
                        </JetResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">
                                    {{ user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">
                                    {{ user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <JetResponsiveNavLink 
                                :href="route('profile.show')" 
                                :active="route().current('profile.show')"
                            >
                                Profile
                            </JetResponsiveNavLink>

                            <JetResponsiveNavLink 
                                v-if="$page.props.jetstream.hasApiFeatures" 
                                :href="route('api-tokens.index')" 
                                :active="route().current('api-tokens.index')"
                            >
                                API Tokens
                            </JetResponsiveNavLink>

                            <!-- Authentication -->
                            <form 
                                method="POST" 
                                @submit.prevent="logout"
                            >
                                <JetResponsiveNavLink as="button">
                                    Log Out
                                </JetResponsiveNavLink>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200" />

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <JetResponsiveNavLink 
                                    :href="route('teams.show', user.current_team)" 
                                    :active="route().current('teams.show')"
                                >
                                    Team Settings
                                </JetResponsiveNavLink>

                                <JetResponsiveNavLink 
                                    v-if="$page.props.jetstream.canCreateTeams" 
                                    :href="route('teams.create')" 
                                    :active="route().current('teams.create')"
                                >
                                    Create New Team
                                </JetResponsiveNavLink>

                                <!-- Team Switcher -->
                                <template>
                                    <div class="border-t border-gray-200" />

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Switch Teams
                                    </div>

                                    <template 
                                        v-for="team in user.all_teams" 
                                        :key="team.id"
                                    >
                                        <form @submit.prevent="switchToTeam(team)">
                                            <JetResponsiveNavLink as="button">
                                                <div class="flex items-center">
                                                    <svg 
                                                        v-if="team.id == user.current_team_id" 
                                                        class="me-2 h-5 w-5 text-green-400" 
                                                        xmlns="http://www.w3.org/2000/svg" 
                                                        fill="none" 
                                                        viewBox="0 0 24 24" 
                                                        stroke-width="1.5" 
                                                        stroke="currentColor"
                                                    >
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <div>{{ team.name }}</div>
                                                </div>
                                            </JetResponsiveNavLink>
                                        </form>
                                    </template>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div style="min-height: calc(100vh - 236px)">
                    <slot />
                </div>

                <AppFooter />
            </main>
        </div>
    </div>
</template>
