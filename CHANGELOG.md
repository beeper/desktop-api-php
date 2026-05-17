# Changelog

## 5.0.0 (2026-05-17)

Full Changelog: [v0.0.1...v5.0.0](https://github.com/beeper/desktop-api-php/compare/v0.0.1...v5.0.0)

### Features

* **api:** add app session, login, verifications with qr/sas/recovery_key methods ([3cf0642](https://github.com/beeper/desktop-api-php/commit/3cf0642592da3f70b89d6bcbc1113d2418ecad34))
* **api:** add network, bridge fields to accounts ([8b25044](https://github.com/beeper/desktop-api-php/commit/8b250446d8d538fc1027c9df483f07034049e302))
* **api:** api update ([5d85acf](https://github.com/beeper/desktop-api-php/commit/5d85acfa656a98e7cc58354d5d27ca4abb9e4b27))
* **api:** api update ([d5d8954](https://github.com/beeper/desktop-api-php/commit/d5d89549d1dcdb03ebd079062c25917f76de162e))
* **api:** api update ([48ca998](https://github.com/beeper/desktop-api-php/commit/48ca99875d9640e728922eab3eed6988fcd4ea14))
* **api:** api update ([e098615](https://github.com/beeper/desktop-api-php/commit/e0986159d91fbd76d8647de9e2f7e2f1aedb071f))
* **api:** api update ([fe6b606](https://github.com/beeper/desktop-api-php/commit/fe6b606f1e40643b6f81a68bfbf467653d070a6a))
* **api:** api update ([f813329](https://github.com/beeper/desktop-api-php/commit/f8133290552840e3723a0f67371a4481039c5ac6))
* **api:** api update ([1c754b3](https://github.com/beeper/desktop-api-php/commit/1c754b319cf35db0357cd97d9713119b78f70fc5))
* **api:** manual updates ([46dbc09](https://github.com/beeper/desktop-api-php/commit/46dbc095defeac9aa95e41cd668e883fcd20bea9))
* **api:** update via SDK Studio ([1c4d0e7](https://github.com/beeper/desktop-api-php/commit/1c4d0e7cb265c3bfcca18b886ec84d25eb7154d2))
* **api:** update via SDK Studio ([e372296](https://github.com/beeper/desktop-api-php/commit/e372296e9885f6bb33819a22d29e92ac725395f1))
* support setting headers via env ([91d9d0e](https://github.com/beeper/desktop-api-php/commit/91d9d0e7e5e35f90aa52187308f366ceb438080b))


### Bug Fixes

* **client:** properly generate file params ([44ea2d6](https://github.com/beeper/desktop-api-php/commit/44ea2d6f7210b88dd61b764242e7a68254f07efb))
* **client:** resolve serialization issue with unions and enums ([7d947c2](https://github.com/beeper/desktop-api-php/commit/7d947c2190514f5039947136a1e795e69069d42b))
* guzzle requires special handling to enable streaming ([3a41088](https://github.com/beeper/desktop-api-php/commit/3a41088103be62e91f609605f2b5e994921a68dc))
* populate enum-typed properties with enum instances ([8c3b6fc](https://github.com/beeper/desktop-api-php/commit/8c3b6fc3be27e61cfb5556fab51f29bff5eae2e6))
* revert enum parsing change that lead to unconditional failure ([82c146a](https://github.com/beeper/desktop-api-php/commit/82c146af6213f707f29059eed0d9061aa0555c4b))


### Chores

* **internal:** codegen related update ([297da59](https://github.com/beeper/desktop-api-php/commit/297da598fb4ba18fec57a63e461e4316f3d6e641))
* **internal:** tweak CI branches ([d3967d0](https://github.com/beeper/desktop-api-php/commit/d3967d0433e63e905f0d9699da709a7544ec12db))
* **internal:** update multipart form array serialization ([05282bb](https://github.com/beeper/desktop-api-php/commit/05282bbbaad46dceff167998b75e34a778f42a24))
* **internal:** upgrade phpunit ([958db57](https://github.com/beeper/desktop-api-php/commit/958db5719fcca4f33c8b9c4796e34b8a3c5a8d91))
* **test:** do not count install time for mock server timeout ([344cf76](https://github.com/beeper/desktop-api-php/commit/344cf76b4dc4c254d6c380f035e8b6d2d86fb138))
* **tests:** bump steady to v0.19.4 ([5ead500](https://github.com/beeper/desktop-api-php/commit/5ead500c3d450d125dee608bc6ec0054e6928e15))
* **tests:** bump steady to v0.19.5 ([1987ab0](https://github.com/beeper/desktop-api-php/commit/1987ab0fcc91f0bebfdf55a94fd5b6c59f3658e3))
* **tests:** bump steady to v0.19.6 ([5299bea](https://github.com/beeper/desktop-api-php/commit/5299bea39412364752a5a21800bc9e5837cbce81))
* **tests:** bump steady to v0.19.7 ([356dd2b](https://github.com/beeper/desktop-api-php/commit/356dd2b76fe8549a90e60013ad72e3fd5683e3cd))
* **tests:** bump steady to v0.20.1 ([9a809f7](https://github.com/beeper/desktop-api-php/commit/9a809f782c368dbed079b96555a27f76f39a9b42))
* **tests:** bump steady to v0.20.2 ([71daf35](https://github.com/beeper/desktop-api-php/commit/71daf3588b2f471df63c4070b121e8c5587e5727))
* **tests:** bump steady to v0.22.1 ([192de54](https://github.com/beeper/desktop-api-php/commit/192de547707b52e2d5f60984af9d2c153bef2060))


### Refactors

* **tests:** switch from prism to steady ([b2a0994](https://github.com/beeper/desktop-api-php/commit/b2a099467ced88b63d36ae05aa4db7da5b5c64c8))
