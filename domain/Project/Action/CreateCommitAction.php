<?php

declare(strict_types=1);

namespace Domain\Project\Action;

use Domain\Project\DTO\CreateCommitData;
use Domain\Project\Models\Commit;
use Illuminate\Support\Facades\DB;

class CreateCommitAction
{
    public function __invoke(CreateCommitData $data): Commit
    {
        try {
            DB::beginTransaction();

            $commit = Commit::create([
                'name' => $data->name,
                'body' => $data->body,
                'prerelease' => $data->prerelease,
                'make_latest' => $data->make_latest,
                'tag_name' => $data->tag_name,
                'user_id' => $data->user_id,
                'project_id' => $data->project_id,
            ]);

            // TODO: make release on github from team project
            // If project connected to github repo and user connected to github, make a release
            if ($commit->project->github_repo_id
             && $commit->user->github_access_token) {
                $github = $commit->user->github();

                $username = $github->me()->show()['login'];

                $repos = $github->currentUser()->repositories();
                $repo = array_filter($repos, fn($repo) => $repo['id'] == $commit->project->github_repo_id);
                $repo_name = reset($repo)['name'];


                $release = $commit->user->github()->api('repo')->releases()->create(
                    $username, $repo_name,
                    [
                        'tag_name' => $commit->tag_name,
                        'name' => $commit->name,
                        'body' => $commit->body,
                        'prerelease' => $commit->prerelease,
                    ]
                );
            }

            DB::commit();
            return $commit;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
