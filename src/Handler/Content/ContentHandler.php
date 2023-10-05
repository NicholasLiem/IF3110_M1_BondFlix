<?php
namespace Handler\Content;

use Core\Application\Services\ContentService;
use Exception;
use Handler\BaseHandler;
use Utils\ArrayMapper\ArrayMapper;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

//TODO: exception handling

class ContentHandler extends BaseHandler {
    
    protected static ContentHandler $instance;
    private function __construct(ContentService $contentService)
    {
        $this->service = $contentService;
    }

    public static function getInstance($contentService): ContentHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $contentService
            );
        }
        return self::$instance;
    }

    /*
     * route formats: 
     * /api/content => get all content data
     * /api/content?page={p} => get content data at page p
     * /api/content?content_id={id} => get a content with a specific id
     */
    protected function get($params = null): void
    {
        try {
            $resultArray = [];
            $page = isset($params['page']) ? intval($params['page']) : 1;
            $pageSize = isset($params['pageSize']) ? intval($params['pageSize']) : 10;

            if (isset($params['content_id'])) {
                $content = $this->service->getContentById($params['content_id']);
                $resultArray[] = $content->toArray();
            } else {
                if (isset($params['query']) && isset($params['sortAscending'])) {
                    $query = $params['query'];
                    $sortAscending = filter_var($params['sortAscending'], FILTER_VALIDATE_BOOLEAN);

                    $result = $this->service->processContentQuery($query);
                    $filteredResult = $result;

                    /**
                     * Filtering part
                     */

                    if ($sortAscending) {
                        usort($filteredResult, function ($a, $b) {
                            return strcmp($a->getTitle(), $b->getTitle());
                        });
                    } else {
                        usort($filteredResult, function ($a, $b) {
                            return strcmp($b->getTitle(), $a->getTitle());
                        });
                    }

                    $totalPages = ceil(count($filteredResult) / $pageSize);
                    header("X-Total-Pages: " . $totalPages);
                    $startIndex = ($page - 1) * $pageSize;
                    $pagedResult = array_slice($filteredResult, $startIndex, $pageSize);
                } else {
                    $contents = $this->service->getAllContents();
                    $totalContents = count($contents);
                    $totalPages = ceil($totalContents / $pageSize);
                    header("X-Total-Pages: " . $totalPages);
                    $page = max(1, min($page, $totalPages));

                    $startIndex = ($page - 1) * $pageSize;
                    $pagedResult = array_slice($contents, $startIndex, $pageSize);
                }

                $resultArray = ArrayMapper::mapObjectsToArray($pagedResult);
            }

            if (!empty($resultArray)) {
                $response = new Response(true, HttpStatusCode::OK, "data retrieved successfully", $resultArray);
            } else {
                $response = new Response(false, HttpStatusCode::OK, "data not found", null);
            }
            $response->encode_to_JSON();
            return;
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::NOT_FOUND, "Request failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
            return;
        }
    }

    protected function post($params = null)
    {
        try {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $release_date = $_POST['release_date'];
            $content_file_path = $_POST['content_file_path'];
            $thumbnail_file_path = $_POST['thumbnail_file_path'];

            $content = $this->service->createContent(
                $title,
                $description,
                $release_date,
                $content_file_path,
                $thumbnail_file_path
            );

            $response = new Response(true, HttpStatusCode::OK, "Content created successfully", $content->toArray());
            $response->encode_to_JSON();

        } catch (Exception $e) {

            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Content creation failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }

    protected function put($params = null)
    {
        try {
            $putData = file_get_contents('php://input');
            parse_str($putData, $_PUT);

            $content_id = $_PUT['content_id'];

            if (is_null($this->service->getContentById($content_id))) {
                $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Content not found", null);
                $response->encode_to_JSON();
                return;
            }

            $title = $_PUT['title'] ?? null;
            $description = $_PUT['description'] ?? null;
            $release_date = $_PUT['release_date'] ?? null;
            $content_file_path = $_PUT['content_file_path'] ?? null;
            $thumbnail_file_path = $_PUT['thumbnail_file_path'] ?? null;

            $content = $this->service->updateContent(
                $content_id,
                $title,
                $description,
                $release_date,
                $content_file_path,
                $thumbnail_file_path
            );

            $response = new Response(true, HttpStatusCode::OK, "Content updated successfully", $content->toArray());
            $response->encode_to_JSON();

        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Content update failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }

    }

    /*
     * route formats: 
     * /api/content?content_id={id} => delete a content with a specific id
     */
    protected function delete($params = null)
    {
        try {
            if (is_null($this->service->getContentById($params['content_id']))) {
                $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Content not found", null);
                $response->encode_to_JSON();
                return;
            }
            $this->service->removeContent($params['content_id']);
            $response = new Response(true, HttpStatusCode::OK, "Content deleted successfully", null);
            $response->encode_to_JSON();
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Content deletion failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }
}