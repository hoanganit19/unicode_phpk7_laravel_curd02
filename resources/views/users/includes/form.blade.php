<form action="" method="post">
    <div class="mb-3">
        <label for="">Tên</label>
        <input type="text" name="name" class="form-control" placeholder="Tên..." value="{{getValueInput('name', $user??'')}}">
        @error('name')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control" placeholder="Email..." value="{{getValueInput('email', $user??'')}}">
        @error('email')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="">Điện thoại</label>
        <input type="text" name="phone" class="form-control" placeholder="Điện thoại..." value="{{getValueInput('phone', $user??'')}}">
        @error('phone')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="">Nhóm</label>
        <select name="group_id" class="form-control">
            <option value="0">Chọn nhóm</option>
            @if ($groups->count()>0)
                @foreach($groups as $group)
                    <option value="{{$group->id}}" {{isSelected('group_id', $user ?? '', $group->id)}}>{{$group->name}}</option>
                @endforeach
            @endif
        </select>
        @error('group_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="">Trạng thái</label>
        <select name="status" class="form-control">
            <option value="0" {{isSelected('group_id', $user ?? '', 0)}}>Chưa kích hoạt</option>
            <option value="1" {{isSelected('group_id', $user ?? '', 1)}}>Kích hoạt</option>
        </select>
        @error('status')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Lưu</button>

    @csrf
</form>
