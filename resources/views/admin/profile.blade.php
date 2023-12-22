@extends('layout.admin')

@section('content')
  <div class="container">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>

          <p class="mt-1 text-sm text-gray-600">
            Update your accounts profile information and email address.
          </p>
        </div>

        <div class="px-4 sm:px-0">

        </div>
      </div>

      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="{{ route('admin.profile.update') }}" method="POST">
          @csrf
          <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            @if(session()->has('updateProfile'))
              {!! session()->get('updateProfile') !!}
            @endif
            <div class="grid grid-cols-6 gap-6">

              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="name">Name (English)</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('name') is-invalid @enderror"
                  id="name"
                  name="name" type="text" autocomplete="name" value="{{ old('name', auth()->user()->name) }}">
                @error('name')
                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                @enderror
              </div>

              <!-- Email -->
              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="email">Email</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('email') is-invalid @enderror"
                  id="email"
                  name="email" type="email" autocomplete="email" value="{{ old('email', auth()->user()->email) }}">
                @error('email')
                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                @enderror
              </div>
              <!-- Phone -->
              <div class="col-span-6 sm:col-span-4">
                <label class="block font-medium text-sm text-gray-700" for="phone">Phone</label>
                <input
                  class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full @error('phone') is-invalid @enderror"
                  id="phone"
                  name="phone" type="number" autocomplete="phone" value="{{ old('phone', auth()->user()->phone) }}">
                @error('phone')
                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                @enderror
              </div>
            </div>
          </div>

          <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="hidden sm:block">
      <div class="py-8">
        <div class="border-t border-gray-200"></div>
      </div>
    </div>

    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Update Password</h3>

            <p class="mt-1 text-sm text-gray-600">
              Ensure your account is using a long, random password to stay secure.
            </p>
          </div>

          <div class="px-4 sm:px-0">

          </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
          <form action="{{ route('admin.password.update') }}" method="POST">
            @csrf
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
              @if(session()->has('updatePassword'))
                {!! session()->get('updatePassword') !!}
              @endif
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-4">
                  <label class="block font-medium text-sm text-gray-700" for="current_password">
                    Current Password
                  </label>
                  <input
                    class="@error('current_password') is-invalid @enderror border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    id="current_password" name="current_password" type="password" autocomplete="current-password">
                  @error('current_password')
                  <strong class="text-danger">{{ $errors->first('current_password') }}</strong>
                  @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label class="block font-medium text-sm text-gray-700" for="password">
                    New Password
                  </label>
                  <input
                    class="@error('password') is-invalid @enderror border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    id="password" name="password"
                    type="password" autocomplete="new-password">
                  @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                  @enderror
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                    Confirm Password
                  </label>
                  <input
                    class="@error('password_confirmation') is-invalid @enderror border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                  @error('password_confirmation')
                  <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
              <button type="submit"
                      class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="hidden sm:block">
      <div class="py-8">
        <div class="border-t border-gray-200"></div>
      </div>
    </div>


    {{--    <div class="mt-10 sm:mt-0">--}}
    {{--      <div class="md:grid md:grid-cols-3 md:gap-6">--}}
    {{--        <div class="md:col-span-1 flex justify-between">--}}
    {{--          <div class="px-4 sm:px-0">--}}
    {{--            <h3 class="text-lg font-medium text-gray-900">Browser Sessions</h3>--}}

    {{--            <p class="mt-1 text-sm text-gray-600">--}}
    {{--              Manage and log out your active sessions on other browsers and devices.--}}
    {{--            </p>--}}
    {{--          </div>--}}

    {{--          <div class="px-4 sm:px-0">--}}

    {{--          </div>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    </div>--}}

    {{--    <div class="hidden sm:block">--}}
    {{--      <div class="py-8">--}}
    {{--        <div class="border-t border-gray-200"></div>--}}
    {{--      </div>--}}
    {{--    </div>--}}

    <div class="mt-10 sm:mt-0">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
          <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Delete Account</h3>

            <p class="mt-1 text-sm text-gray-600">
              Permanently delete your account.
            </p>
          </div>

          <div class="px-4 sm:px-0">

          </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
          <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl text-sm text-gray-600">
              Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that
              you wish to retain.
            </div>

            <div class="mt-5">
              <button type="button"
                      class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                Delete Account
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

@endsection
