<?php

namespace App\Service;

class EmojiConverter
{
    private array $emojiMap = [
        // Smileys
        ':)' => '😊',
        ':-)' => '😊',
        ':(' => '😞',
        ':-(' => '😞',
        ':D' => '😃',
        ':-D' => '😃',
        ';)' => '😉',
        ';-)' => '😉',
        ':P' => '😛',
        ':-P' => '😛',
        ':p' => '😛',
        ':-p' => '😛',
        ':O' => '😮',
        ':-O' => '😮',
        ':o' => '😮',
        ':-o' => '😮',
        ':|' => '😐',
        ':-|' => '😐',
        ':/' => '😕',
        ':-/' => '😕',
        ':*' => '😘',
        ':-*' => '😘',
        '>:(' => '😠',
        '>:-(' => '😠',
        'XD' => '😆',
        'xD' => '😆',
        'x)' => '😆',
        'X)' => '😆',
        '8)' => '😎',
        '8-)' => '😎',
        'B)' => '😎',
        'B-)' => '😎',
        ':\'(' => '😢',
        ':\'-)' => '😂',
        ':3' => '😺',
        '^_^' => '😄',
        '^-^' => '😄',
        '^.^' => '😄',
        '^__^' => '😄',
        ':S' => '😖',
        ':-S' => '😖',
        ':s' => '😖',
        ':-s' => '😖',
        ':@' => '😡',
        ':-@' => '😡',
        ':$' => '😳',
        ':-$' => '😳',

        // Hearts
        '<3' => '❤️',
        '</3' => '💔',
        '<33' => '💕',
        '<333' => '💗',

        // Hands
        'o/' => '👋',
        '\o' => '🙋',
        '\o/' => '🙌',
        '_/\\_' => '🙏',
        ':clap:' => '👏',
        ':thumbsup:' => '👍',
        ':thumbsdown:' => '👎',
        ':ok:' => '👌',
        ':punch:' => '👊',
        ':fist:' => '✊',
        ':v:' => '✌️',
        ':wave:' => '👋',
        ':raised_hand:' => '✋',
        ':muscle:' => '💪',
        
        // Objects
        ':star:' => '⭐',
        ':sparkles:' => '✨',
        ':zap:' => '⚡',
        ':fire:' => '🔥',
        ':sun:' => '☀️',
        ':moon:' => '🌙',
        ':cloud:' => '☁️',
        ':umbrella:' => '☔',
        ':snowflake:' => '❄️',
        ':phone:' => '📱',
        ':computer:' => '💻',
        ':book:' => '📚',
        ':bulb:' => '💡',
        ':warning:' => '⚠️',
        ':bell:' => '🔔',
        ':lock:' => '🔒',
        ':key:' => '🔑',
        ':mag:' => '🔍',
        ':gift:' => '🎁',
        ':cake:' => '🍰',
        ':coffee:' => '☕',
        ':pizza:' => '🍕',
        ':beer:' => '🍺',
        ':wine:' => '🍷',
        
        // Animals
        ':cat:' => '🐱',
        ':dog:' => '🐶',
        ':mouse:' => '🐭',
        ':hamster:' => '🐹',
        ':rabbit:' => '🐰',
        ':bear:' => '🐻',
        ':panda:' => '🐼',
        ':penguin:' => '🐧',
        ':bird:' => '🐦',
        ':frog:' => '🐸',
        ':monkey:' => '🐵',
        ':snake:' => '🐍',
        ':turtle:' => '🐢',
        ':fish:' => '🐠',
        ':dolphin:' => '🐬',
        ':whale:' => '🐳',
        ':cow:' => '🐮',
        ':pig:' => '🐷',
        ':tiger:' => '🐯',
        ':lion:' => '🦁',
        
        // Symbols
        ':100:' => '💯',
        ':+1:' => '👍',
        ':-1:' => '👎',
        ':check:' => '✅',
        ':x:' => '❌',
        ':o:' => '⭕',
        ':exclamation:' => '❗',
        ':question:' => '❓',
        ':copyright:' => '©️',
        ':registered:' => '®️',
        ':tm:' => '™️',
        ':hash:' => '#️⃣',
        ':arrow_up:' => '⬆️',
        ':arrow_down:' => '⬇️',
        ':arrow_left:' => '⬅️',
        ':arrow_right:' => '➡️',
    ];

    /**
     * Convert text emoticons to emoji characters
     */
    public function convertToEmojis(string $text): string
    {
        // Replace all emoticons with their emoji equivalents
        foreach ($this->emojiMap as $emoticon => $emoji) {
            // Use word boundaries to avoid replacing parts of words
            // But for some emoticons like :) we need special handling
            if (in_array($emoticon, [':(', ':)', ':D', ':P', ':p', ':O', ':o', ':|', ':/', ':*', 'XD', 'xD'])) {
                // For these common emoticons, use a lookahead/lookbehind to ensure they're not part of words
                $text = preg_replace('/(?<!\w)' . preg_quote($emoticon, '/') . '(?!\w)/', $emoji, $text);
            } else {
                // For other emoticons, simple replacement is fine
                $text = str_replace($emoticon, $emoji, $text);
            }
        }

        return $text;
    }

    /**
     * Get the full emoji map
     */
    public function getEmojiMap(): array
    {
        return $this->emojiMap;
    }
}
