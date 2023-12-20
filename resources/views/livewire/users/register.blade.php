   <form wire:submit='create'>
       <label for="chk" aria-hidden="true">Sign up</label>
       <div class="input-regist">
           <input type="text" wire:model.live='form.name' name="name" placeholder="Name">
           @error('form.name')
               <i class="error-input">{{ $message }}</i>
           @enderror
       </div>
       <div class="input-regist">
           <input type="text" wire:model.live='form.username' name="txt" placeholder="User name">
           @error('form.username')
               <i class="error-input">{{ $message }}</i>
           @enderror
       </div>
       <div class="input-regist">
           <input type="email" name="email" wire:model.live='form.email' placeholder="Email">
           @error('form.email')
               <i class="error-input">{{ $message }}</i>
           @enderror
       </div>
       <div class="input-regist">
           <input type="password" name="pswd" wire:model.live='form.password' placeholder="Password">
           @error('form.password')
               <i class="error-input">{{ $message }}</i>
           @enderror
       </div>
       <button type="submit">Sign up</button>
   </form>
