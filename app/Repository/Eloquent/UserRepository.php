<?php
namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserInterfaceRepository;

class UserRepository implements UserInterfaceRepository
{
    protected User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all($fields = ['*']): \Illuminate\Database\Eloquent\Collection
    {
        return $this->user->select($fields)->all();
    }

    public function detail($id, $fields = ['*'])
    {
        return $this->user->select($fields)->where('id', $id)->first();
    }

    public function list($fields = ['*'], $options = []): \Illuminate\Database\Eloquent\Collection
    {
        return $this->user->select($fields)->paginate($options['limit'] ?? null);
    }

    public function update($id, $data): bool
    {
        return $this->user->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->user->delete($id);

    }

    public function create($data)
    {
        return $this->user->create($data);
    }

    public function findByEmail($email, $fields = ['*'])
    {
       return $this->user->select($fields)->where('email', $email)->first();
    }
}
