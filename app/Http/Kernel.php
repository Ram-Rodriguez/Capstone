protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\SetAuditUser::class,
    ],
    'api' => [
        \App\Http\Middleware\SetAuditUser::class,
    ],
];
