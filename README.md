# YakNet Subtext 2.0 (AI-Powered Developer Intelligence)

[![PHP Version](https://img.shields.io/badge/php-%5E8.2-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![AI Powered](https://img.shields.io/badge/AI-Powered-purple.svg)](https://gemini.google.com)

**YakNet Subtext**, kodunuzun satır aralarındaki hikayeyi ortaya çıkaran devrimsel bir araçtır. Kod yorumlarınızı (Comments) analiz ederek geliştirici psikolojisini, teknik borçları ve gizli riskleri yapay zeka desteğiyle raporlar.

## 🌟 Öne Çıkan Özellikler

- **🧠 AI Developer Psychology:** Geliştiricinin yorum yazarkenki ruh halini (stres, mutluluk, acele) analiz eder.
- **🛡️ Security Scanner:** Yorumlarda unutulmuş şifreleri, API anahtarlarını veya hassas dahili bilgileri tespit eder.
- **📊 Technical Debt Insights:** `@TODO`, `@FIX`, `@HACK` notlarını analiz ederek projenin teknik sağlığını raporlar.
- **🔍 Context-Aware Parsing:** Sadece yorumu değil, yorumun hangi kod bloğuna ait olduğunu (Context) da anlar.
- **⚡ Modern CLI:** Tüm projenizi saniyeler içinde tarayıp "Geliştirici Günlüğü" oluşturmanızı sağlar.

## 📦 Kurulum

Composer ile projenize hemen dahil edin:

```bash
composer require yaknet/subtext
```

## 🚀 CLI Kullanımı

Kütüphane, `vendor/bin/subtext` üzerinden kullanılabilir.

### 1. Temel Analiz
Bir dosyadaki veya klasördeki tüm yorumları ve kod bağlamlarını listeleyin:
```bash
bin/subtext analyze src/
```

### 2. Yapay Zeka Destekli Psikolojik Analiz
Geliştiricinin zihin haritasını ve teknik borçları Gemini AI ile raporlayın:
```bash
bin/subtext analyze src/ --ai
```

## 💻 Kütüphane Olarak Kullanım

Uygulamanızın çalışma anında (Runtime) yorumları JSON olarak dışarı aktarabilirsiniz:

```php
use YakNet\Subtext\Subtext;

// İlk parametre: Aktiflik kontrolü (true ise JSON çıktısı verir ve durur)
// İkinci parametre: AI analizi dahil edilsin mi?
Subtext::run(isset($_GET['debug']), true); 
```

## ⚙️ Yapılandırma

AI özelliklerini kullanabilmek için projenizin kök dizininde bir `.env` dosyası oluşturun ve **Google Gemini API** anahtarınızı ekleyin:

```env
GEMINI_API_KEY=AIzaSyA...your_key_here
```

## 🧠 Neden Subtext?

Kodunuz sadece ne yaptığını anlatır, ama yorumlarınız **neden** o şekilde yapıldığını fısıldar. Subtext, bu fısıltıları profesyonel raporlara dönüştürerek:
- Takıma yeni katılanların projeyi daha iyi anlamasını sağlar.
- Aceleyle yazılmış tehlikeli çözümleri (hacks) gün yüzüne çıkarır.
- Projenin "insani" tarafını (geliştirici motivasyonunu) ölçer.

## 🤝 Katkıda Bulunma

Bu proje **YakNet Bilişim** tarafından açık kaynak topluluğuna bir armağan olarak geliştirilmiştir. Pull Request ve Issue bildirimleriniz baş tacıdır.

## 📜 Lisans

Bu yazılım **MIT Lisansı** altında lisanslanmıştır. Detaylar için [LICENSE](LICENSE) dosyasına göz atabilirsiniz.
