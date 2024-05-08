/**
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */
/// <reference path="../src/plugin-content-pages.d.ts" />
import type { PageFrontMatter } from '@docusaurus/plugin-content-pages';
export declare function validatePageFrontMatter(frontMatter: {
    [key: string]: unknown;
}): PageFrontMatter;
