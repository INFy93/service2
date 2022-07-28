<template>
  <main>
    <div class="py-3 bg-gray-100">
      <div class="max-w-7xl mx-auto">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
              <h3
                class="text-lg font-semibold text-gray-900 dark:text-gray-400"
              >
                Персональные данные
              </h3>
              <p class="mt-1 text-sm text-gray-600 dark:text-gray-500">
                Сменить имя и e-mail
              </p>
            </div>
          </div>
          <div class="md:mt-0 md:col-span-2">
            <Form @submit="editUserData" :validation-schema="schema">
              <div
                class="
                  px-4
                  py-5
                  bg-white
                  dark:bg-gray-600
                  sm:p-6
                  shadow
                  sm:rounded-tl-md sm:rounded-tr-md
                "
              >
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-4">
                    <label
                      class="
                        block
                        font-medium
                        text-sm text-gray-700
                        dark:text-gray-300
                      "
                      for="name"
                    >
                      Имя
                    </label>
                    <Field
                      v-model="userData.name"
                      class="
                        pl-2
                        text-base
                        h-10
                        border-gray-500 border
                        dark:border-gray-600 dark:bg-gray-500 dark:text-gray-100
                        rounded-md
                        shadow-sm
                        mt-1
                        block
                        w-full
                      "
                      name="user_name"
                      type="text"
                    />
                    <ErrorMessage
                      name="user_name"
                      class="text-sm text-red-500"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-4">
                    <label
                      class="
                        block
                        font-medium
                        text-sm text-gray-700
                        dark:text-gray-300
                      "
                      for="email"
                    >
                      Email
                    </label>
                    <Field
                      v-model="userData.email"
                      class="
                        pl-2
                        text-base
                        h-10
                        border-gray-500 border
                        dark:border-gray-600 dark:bg-gray-500 dark:text-gray-100
                        rounded-md
                        shadow-sm
                        mt-1
                        block
                        w-full
                      "
                      name="email"
                      type="email"
                    />
                    <ErrorMessage name="email" class="text-sm text-red-500" />
                  </div>
                </div>
              </div>
              <div
                class="
                  flex
                  items-center
                  justify-end
                  px-4
                  py-3
                  bg-gray-50
                  dark:bg-gray-600
                  border-t
                  dark:border-gray-500
                  text-right
                  sm:px-6
                  shadow
                  sm:rounded-bl-md sm:rounded-br-md
                "
              >
                <div class="info_field text-sm text-gray-600 mr-3"></div>
                <button
                  class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    bg-gray-800
                    border border-transparent
                    rounded-md
                    font-semibold
                    text-xs text-white
                    uppercase
                    tracking-widest
                    hover:bg-gray-700
                    active:bg-gray-900
                    focus:outline-none
                    focus:border-gray-900
                    focus:ring
                    focus:ring-gray-300
                    disabled:opacity-25
                    transition
                  "
                >
                  Сохранить
                </button>
              </div>
            </Form>
          </div>
        </div>
      </div>
      <div class="max-w-7xl mx-auto mt-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
          <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
              <h3
                class="text-lg font-semibold text-gray-900 dark:text-gray-400"
              >
                Смена пароля
              </h3>
              <p class="mt-1 text-sm text-gray-600 dark:text-gray-500">
                Пароль должен быть длиннее 8 символов и использовать буквы
                разного регистра и специмволы ("", - и тп).
              </p>
            </div>
          </div>
          <div class="md:mt-0 md:col-span-2">
            <Form @submit="changePassword" :validation-schema="password_shema">
              <div
                class="
                  px-4
                  py-5
                  bg-white
                  dark:bg-gray-600
                  sm:p-6
                  shadow
                  sm:rounded-tl-md sm:rounded-tr-md
                "
              >
                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-4">
                    <label
                      class="
                        block
                        font-medium
                        text-sm text-gray-700
                        dark:text-gray-300
                      "
                      for="pass"
                    >
                      Новый пароль
                    </label>
                    <Field
                      v-model="password"
                      class="
                        pl-1
                        h-10
                        border-gray-500 border
                        dark:border-gray-600 dark:bg-gray-500 dark:text-gray-100
                        rounded-md
                        shadow-sm
                        mt-1
                        block
                        w-full
                      "
                      name="password"
                      type="password"
                    />
                    <ErrorMessage
                      name="password"
                      class="text-sm text-red-500"
                    />
                  </div>
                  <div class="col-span-6 sm:col-span-4">
                    <label
                      class="
                        block
                        font-medium
                        text-sm text-gray-700
                        dark:text-gray-300
                      "
                      for="confirm_pass"
                    >
                      Подтверждение
                    </label>
                    <Field
                      class="
                        pl-1
                        h-10
                        border-gray-500 border
                        dark:border-gray-600 dark:bg-gray-500 dark:text-gray-100
                        rounded-md
                        shadow-sm
                        mt-1
                        block
                        w-full
                      "
                      name="confirm_password"
                      type="password"
                    />
                    <ErrorMessage
                      name="confirm_password"
                      class="text-sm text-red-500"
                    />
                  </div>
                </div>
              </div>
              <div
                class="
                  flex
                  items-center
                  justify-end
                  px-4
                  py-3
                  bg-gray-50
                  dark:bg-gray-600
                  border-t
                  dark:border-gray-500
                  text-right
                  sm:px-6
                  shadow
                  sm:rounded-bl-md sm:rounded-br-md
                "
              >
                <div class="info_field text-sm text-gray-600 mr-3"></div>
                <button
                  class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    bg-gray-800
                    border border-transparent
                    rounded-md
                    font-semibold
                    text-xs text-white
                    uppercase
                    tracking-widest
                    hover:bg-gray-700
                    active:bg-gray-900
                    focus:outline-none
                    focus:border-gray-900
                    focus:ring
                    focus:ring-gray-300
                    disabled:opacity-25
                    transition
                  "
                >
                  Сохранить
                </button>
              </div>
            </Form>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import useProfile from "../../composables/profile/profile";
import * as Yup from "yup";
import { onMounted } from "vue";
export default {
  setup() {
    const { userData, password, updatePassword, changeUser, getUserData } =
      useProfile();

    onMounted(() => {
      getUserData();
    });

    const schema = Yup.object({
      email: Yup.string()
        .required("Необходимо ввести e-mail")
        .email("Проверьте правильность ввода e-mail"),
      user_name: Yup.string().required("Необходимо заполнить поле"),
    });

    const password_shema = Yup.object({
      password: Yup.string()
        .required("Необходимо заполить поле")
        .min(8, "Длина пароля должна быть не менее 8 символов"),
      confirm_password: Yup.string()
        .required("Необходимо заполнить поле")
        .min(8, "Длина пароля должна быть не менее 8 символов")
        .oneOf([Yup.ref("password"), null], "Пароли не совпадают"),
    });

    const editUserData = async () => {
      await changeUser();
    };

    const changePassword = async () => {
      await updatePassword();
    };

    return {
      userData,
      schema,
      password_shema,
      password,
      getUserData,
      editUserData,
      changeUser,
      updatePassword,
      changePassword,
    };
  },
};
</script>
