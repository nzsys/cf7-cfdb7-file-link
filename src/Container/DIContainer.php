<?php declare(strict_types=1);

final class DIContainer
{
    /** @var array<string, callable> */
    private array $registry =[];
    /** @var array<string, object> */
    private array $instances = [];

    public function register(
        string $name,
        callable $resolver
    ): void {
        $this->registry[$name] = $resolver;
    }

    public function get(
        string $name
    ): object {
        if (!isset($this->instances[$name])) {
            $this->instances[$name] = $this->resolve($name);
        }

        return $this->instances[$name];
    }

    private function resolve(
        string $name
    ): object {
        if (!isset($this->registry[$name])) {
            throw new RuntimeException("No resolver registered for {$name}");
        }

        $resolver = $this->registry[$name];
        $instance = $resolver($this);

        if (!is_object($instance)) {
            throw new RuntimeException("Resolver for {$name} did not return an object");
        }

        return $instance;
    }
}
