<?php

use App\Infrastructure\Framework\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\EventDispatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$containerBuilder = new ContainerBuilder();
$containerBuilder->register('context', RequestContext::class);
$containerBuilder->register('matcher', UrlMatcher::class)
    ->setArguments([$routes, new Reference('context')]);

$containerBuilder->register('request_stack', RequestStack::class);
$containerBuilder->register('controller_resolver', ControllerResolver::class);
$containerBuilder->register('argument_resolver', ArgumentResolver::class);

$containerBuilder->register('listener.router', RouterListener::class)
    ->setArguments([new Reference('matcher'), new Reference('request_stack')]);
$containerBuilder->register('listener.response', ResponseListener::class)
    ->setArguments(['UTF-8']);

$containerBuilder->register('dispatcher', EventDispatcher\EventDispatcher::class)
    ->addMethodCall('addSubscriber', [new Reference('listener.router')])
    ->addMethodCall('addSubscriber', [new Reference('listener.response')]);

$containerBuilder->register('kernel', Kernel::class)
    ->setArguments([
        new Reference('dispatcher'),
        new Reference('matcher'),
        new Reference('controller_resolver'),
        new Reference('argument_resolver'),
    ]);

return $containerBuilder;