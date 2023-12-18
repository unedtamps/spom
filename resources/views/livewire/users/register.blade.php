   <form wire:submit='create'>
       <label for="chk" aria-hidden="true">Sign up</label>
       <input type="text" wire:model='form.name' name="name" placeholder="Name" required>
       @error('form.name')
       @enderror

       <input type="text" wire:model='form.username' name="txt" placeholder="User name" required>
       @error('form.username')
       @enderror
       <input type="email" name="email" wire:model='form.email' placeholder="Email" required>
       @error('form.email')
       @enderror
       <input type="password" name="pswd" wire:model='form.password' placeholder="Password" required="">
       @error('form.password')
       @enderror
       <button type="submit">Sign up</button>
   </form>
