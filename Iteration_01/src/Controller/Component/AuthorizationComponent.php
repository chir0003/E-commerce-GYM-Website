<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\ServerRequest;

class AuthorizationComponent extends Component
{
    public function isAdmin(ServerRequest $request): bool
    {
        $user = $request->getAttribute('identity');
        return $user && $user->user_type_id === 2; // 2 is admin type
    }

    public function isCustomer(ServerRequest $request): bool
    {
        $user = $request->getAttribute('identity');
        return $user && $user->user_type_id === 1; // 1 is customer type
    }

    public function initialize(array $config): void
    {
        parent::initialize($config);
    }
}
