<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Docker\API\Endpoint;

class ContainerStats extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\AmpArtaxEndpoint, \Jane\OpenApiRuntime\Client\Psr7HttplugEndpoint
{
    protected $id;

    /**
     * This endpoint returns a live stream of a container’s resource usage.
    statistics.

    The `precpu_stats` is the CPU statistic of last read, which is used
    for calculating the CPU usage percentage. It is not the same as the
    `cpu_stats` field.

    If either `precpu_stats.online_cpus` or `cpu_stats.online_cpus` is
    nil then for compatibility with older daemons the length of the
    corresponding `cpu_usage.percpu_usage` array should be used.

     *
     * @param string $id              ID or name of the container
     * @param array  $queryParameters {
     *
     *     @var bool $stream Stream the output. If false, the stats will be output once and then it will disconnect.
     * }
     */
    public function __construct(string $id, array $queryParameters = [])
    {
        $this->id = $id;
        $this->queryParameters = $queryParameters;
    }

    use \Jane\OpenApiRuntime\Client\AmpArtaxEndpointTrait, \Jane\OpenApiRuntime\Client\Psr7HttplugEndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{id}'], [$this->id], '/containers/{id}/stats');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['stream']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults(['stream' => true]);
        $optionsResolver->setAllowedTypes('stream', ['bool']);

        return $optionsResolver;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Docker\API\Exception\ContainerStatsNotFoundException
     * @throws \Docker\API\Exception\ContainerStatsInternalServerErrorException
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType)
    {
        if (200 === $status) {
            return json_decode($body);
        }
        if (404 === $status) {
            throw new \Docker\API\Exception\ContainerStatsNotFoundException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
        if (500 === $status) {
            throw new \Docker\API\Exception\ContainerStatsInternalServerErrorException($serializer->deserialize($body, 'Docker\\API\\Model\\ErrorResponse', 'json'));
        }
    }
}
