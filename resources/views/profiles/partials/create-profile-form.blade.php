<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Save your profiles's information.") }}
        </p>
    </header>


    <form method="post" action="{{ isset($profile) ? route('profiles.update', $profile->id) : route('profiles.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @if(isset($profile))
        @method('PUT')
        @endif

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="isset($profile) ? $profile->last_name : old('last_name')" required autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="about" :value="__('About')" />
            <x-text-input id="about" name="about" type="text" class="mt-1 block w-full" :value="isset($profile) ? $profile->about : old('about')" required autofocus autocomplete="about" />
            <x-input-error class="mt-2" :messages="$errors->get('about')" />
        </div>

        <div>
            <x-input-label for="skills" :value="__('Skills')" />
            <x-text-input id="skills" name="skills" type="text" class="mt-1 block w-full" :value="isset($profile) ? $profile->skills : old('skills')" required autofocus autocomplete="skills" />
            <x-input-error class="mt-2" :messages="$errors->get('skills')" />
        </div>

        <div>
            <x-input-label for="linkedin" :value="__('LinkedIn')" />
            <x-text-input id="linkedin" name="linkedin" type="text" class="mt-1 block w-full" :value="isset($profile) ? $profile->linkedin : old('linkedin')" required autofocus autocomplete="linkedin" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
        </div>

        <div>
            <x-input-label for="github" :value="__('Github')" />
            <x-text-input id="github" name="github" type="text" class="mt-1 block w-full" :value="isset($profile) ? $profile->github : old('github')" required autofocus autocomplete="github" />
            <x-input-error class="mt-2" :messages="$errors->get('github')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="isset($profile) ? $profile->phone : old('phone')" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="profile_photo" :value="__('Profile photo')" />
            <x-text-input id="profile_photo" name="profile_photo" type="file" class="mt-1 block w-full" :value="isset($profile) ? $profile->profile_photo : old('profile_photo')" autofocus autocomplete="profile_photo" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label for="location" :value="__('Location')" />
            <select id="location" name="location" class="mt-1 block w-full" required>

                <option value="">Select a location</option>

                @foreach($locations as $location)
                <option value="{{ $location }}">{{ $location }}</option>
                @endforeach

            </select>
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        <div>
            <x-input-label for="category" :value="__('Category')" />
            <select id="category" name="category" class="mt-1 block w-full" required>

                <option value="">Select a category</option>
                @foreach($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ isset($profile) ? __('Update') : __('Save') }}</x-primary-button>
        </div>

    </form>

</section>