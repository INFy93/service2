<template>
    <div>
        <TabGroup>
            <TabList class="flex flex-wrap -mb-px font-medium text-center border-b border-gray-200">
                <Tab v-slot="{ selected }" as="template">
                    <button
                        class="mr-2 inline-flex p-4  border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        :class="{ 'border-b-4 border-blue-500' : selected }"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                        Заказы
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                       class="mr-2 inline-flex p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                       :class="{ 'border-b-4 border-blue-500' : selected }"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                        Пользователи
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        class="mr-2 inline-flex p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        :class="{ 'border-b-4 border-blue-500' : selected }"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                        Аналитика
                    </button>
                </Tab>
                <Tab v-slot="{ selected }" as="template">
                    <button
                        class="mr-2 inline-flex p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        :class="{ 'border-b-4 border-blue-500' : selected }"
                    >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                        Общие настройки
                    </button>
                </Tab>
            </TabList>
            <TabPanels class="mt-2">
                <TabPanel
                ><orders-admin></orders-admin></TabPanel>
                <TabPanel
                :class="[
                    'bg-gray-100 rounded-xl p-3'
                ]"
                ><users-admin></users-admin></TabPanel>
                <TabPanel
                :class="[
                    'bg-gray-100 rounded-xl p-3'
                ]"
                ><analytics></analytics></TabPanel>
                <TabPanel
                ><settings></settings></TabPanel>
            </TabPanels>
        </TabGroup>
    </div>
</template>
