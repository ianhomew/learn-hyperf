<?php


namespace App\Controller;


use Hyperf\Config\Annotation\Value;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * @AutoController()
 *
 * Class ConfigController
 * @package App\Controller
 */
class ConfigController
{
    /**
     * @Inject()
     * @var ConfigInterface
     */
    private $config;

    /**
     * @Inject()
     * @var ResponseInterface
     */
    private $response;

    /**
     * @Value("redis.default")
     */
    private $defaultRedisConfig;

    // 第一種方法
    public function config()
    {
        $logLevels = $this->config->get(StdoutLoggerInterface::class . '.log_level');

        return $this->response->json($logLevels);
    }

    // 一樣是第一種方法
    public function autoloadConfig()
    {
        // 在 autoload 資料夾內的需要帶上檔案的名稱才能解析
        $data = $this->config->get('redis.default');

        return $this->response->json($data);
    }

    // 第二種方法 使用 @Value 注入
    public function valueInject()
    {
        return $this->response->json($this->defaultRedisConfig);
    }

    // 第三種方法 使用全局函數
    public function config2()
    {
        return $this->response->json(config('redis.default'));
    }

}