<?php

namespace CollegeAdmin\Services;

use CollegeAdmin\CollegeAdmin;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class VersionChecker
{
    /**
     * Check if a newer version is available.
     *
     * @return array
     */
    public static function check(): array
    {
        if (!config('college-admin.updates.check_enabled', true)) {
            return [
                'has_update' => false,
                'current_version' => CollegeAdmin::version(),
                'latest_version' => CollegeAdmin::version(),
            ];
        }

        $cacheKey = 'college_admin_latest_version_check';
        $cacheHours = config('college-admin.updates.cache_duration_hours', 12);

        return Cache::remember($cacheKey, now()->addHours($cacheHours), function () {
            $currentVersion = CollegeAdmin::version();
            $repo = config('college-admin.updates.github_repo');

            try {
                // Query GitHub Releases API for the latest release tag
                $response = Http::timeout(5)
                    ->withHeaders([
                        'User-Agent' => 'College-Admin-Version-Checker',
                        'Accept' => 'application/vnd.github.v3+json',
                    ])
                    ->get("https://api.github.com/repos/{$repo}/releases/latest");

                if ($response->successful()) {
                    $data = $response->json();
                    $rawTag = $data['tag_name'] ?? '0.0.0';
                    $latestVersion = ltrim($rawTag, 'vV');
                    $releaseNotes = $data['body'] ?? '';
                    $releaseUrl = $data['html_url'] ?? '';

                    $hasUpdate = version_compare($latestVersion, $currentVersion, '>');

                    return [
                        'has_update' => $hasUpdate,
                        'current_version' => $currentVersion,
                        'latest_version' => $latestVersion,
                        'release_notes' => $releaseNotes,
                        'release_url' => $releaseUrl,
                        'published_at' => $data['published_at'] ?? null,
                    ];
                }
            } catch (\Throwable $e) {
                // Offline or GitHub rate limit reached, silently fallback
            }

            return [
                'has_update' => false,
                'current_version' => $currentVersion,
                'latest_version' => $currentVersion,
            ];
        });
    }

    /**
     * Clear cached version check.
     */
    public static function clearCache(): void
    {
        Cache::forget('college_admin_latest_version_check');
    }
}
