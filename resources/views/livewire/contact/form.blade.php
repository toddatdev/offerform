<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <!-- Validation Errors -->
{{--    <x-auth-validation-errors class="mb-4" :errors="$errors"/>--}}

    <form wire:submit.prevent="submit">
        <div class="row ">
            <div class="form-group mb-3">
                <x-input type="text" class="py-4 bg-transparent" name="first_name"
                         placeholder="First Name" wire:model="first_name" />
            </div>

            <div class="form-group mb-3">
                <x-input type="text" class="py-4 bg-transparent" wire:model="last_name" name="last_name"
                         placeholder="Last Name"/>
            </div>

            <div class="form-group mb-3">
                <x-input type="email" class="py-4 bg-transparent" wire:model="email" name="email"
                         placeholder="What’s Your Email?"/>
            </div>

            <div class="form-group mb-3">
                <x-select id="cars" name="hear_about_as" class="py-4 bg-transparent" wire:model="hear_about_us">
                    <option value="">How did you hear about us</option>
                    <option value="facebook">Facebook</option>
                    <option value="youtube">YouTube</option>
                    <option value="podcast">Podcast</option>
                    <option value="real_estate_news">Real Estate News</option>
                    <option value="fellow_agents">Fellow Agents</option>
                    <option value="other">Other</option>
                </x-select>
            </div>

            <div class="form-group mb-3">
                <x-textarea  name="message" class="py-4 bg-transparent" rows="4" placeholder="Your Message..." wire:model="message"/>
            </div>
            <div class="form-group">
                <x-button type="submit"
                       class="btn-primary px-5 py-3 me-md-4 me-lg-4 text-uppercase shadow-sm">
                    <div wire:loading.remove wire:target="submit">
                        Submit
                    </div>
                    <div wire:loading wire:target="submit">
                        Submitting...
                    </div>
                </x-button>
            </div>
        </div>
    </form>
</div>
